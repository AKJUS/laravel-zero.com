<?php

declare(strict_types=1);

namespace App\Support;

use Dom\AdjacentPosition;
use Dom\Element;
use Dom\HTMLDocument;
use Dom\HTMLElement;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use Tempest\Highlight\CommonMark\HighlightExtension;
use Tempest\Highlight\Highlighter;
use Tempest\Highlight\Themes\CssTheme;

/**
 * Turns a documentation markdown file into the HTML the site renders.
 *
 * Beyond the CommonMark conversion this handles the conventions the docs
 * repository uses: bare "<a name>" anchors before headings, a hand-maintained
 * anchor list under the page title, and "> **Note:**" style callouts.
 */
final class DocumentationRenderer
{
    /**
     * Headings shallower than this are not offered in the table of contents.
     */
    private const TOC_LEVELS = [2, 3];

    private ?MarkdownConverter $converter = null;

    /**
     * Render a markdown document.
     *
     * @return array{title: string|null, contents: string, toc: list<array{id: string, title: string, level: int}>}
     */
    public function render(string $markdown): array
    {
        $html = $this->converter()->convert($markdown)->getContent();

        if (trim($html) === '') {
            return ['title' => null, 'contents' => '', 'toc' => []];
        }

        $document = HTMLDocument::createFromString(
            '<!DOCTYPE html><html><body>'.$html.'</body></html>',
            LIBXML_NOERROR,
            'UTF-8',
        );

        $body = $document->body;

        $title = $this->extractTitle($body);

        $this->removeInlineAnchorList($body);
        $this->promoteNamedAnchors($body);

        $toc = $this->linkHeadings($body);

        $this->markCallouts($body);
        $this->wrapCodeBlocks($document, $body);
        $this->wrapTables($document, $body);

        return [
            'title' => $title,
            'contents' => $this->innerHtml($body),
            'toc' => $toc,
        ];
    }

    /**
     * Pull the leading "<h1>" out of the document and return its text.
     *
     * The page template renders the title itself so it can own the spacing
     * between the title, the description and the body.
     */
    private function extractTitle(HTMLElement $body): ?string
    {
        $heading = $body->querySelector('h1');

        if (! $heading instanceof Element) {
            return null;
        }

        $title = trim($heading->textContent);

        $heading->remove();

        return $title === '' ? null : $title;
    }

    /**
     * Drop the hand-maintained anchor list that opens most pages.
     *
     * The right-hand table of contents replaces it. Only a list that precedes
     * every heading and links exclusively to fragments is removed, so genuine
     * content lists are never touched.
     */
    private function removeInlineAnchorList(HTMLElement $body): void
    {
        foreach ($body->childNodes as $node) {
            if (! $node instanceof Element) {
                continue;
            }

            if (in_array(strtolower($node->tagName), ['h2', 'h3', 'h4', 'p'], true)) {
                return;
            }

            if (strtolower($node->tagName) !== 'ul') {
                continue;
            }

            $links = $node->querySelectorAll('a');

            if ($links->length === 0) {
                return;
            }

            foreach ($links as $link) {
                if (! str_starts_with($link->getAttribute('href') ?? '', '#')) {
                    return;
                }
            }

            $node->remove();

            return;
        }
    }

    /**
     * Move "<a name="x">" identifiers onto the heading that follows them.
     *
     * The docs repository links between sections using these anchors, so the
     * authored name wins over a generated slug to keep those links working.
     */
    private function promoteNamedAnchors(HTMLElement $body): void
    {
        foreach (iterator_to_array($body->querySelectorAll('a[name]')) as $anchor) {
            $name = $anchor->getAttribute('name');

            // CommonMark wraps a standalone anchor in its own paragraph. That
            // paragraph, not the anchor, is what sits next to the heading.
            $parent = $anchor->parentElement;

            $carrier = $parent instanceof Element
                && strtolower($parent->tagName) === 'p'
                && trim($parent->textContent) === ''
                    ? $parent
                    : $anchor;

            $target = $carrier->nextElementSibling;

            if ($name !== null && $target instanceof Element && preg_match('/^h[1-6]$/i', $target->tagName) === 1) {
                $target->setAttribute('id', $name);
            }

            $carrier->remove();
        }
    }

    /**
     * Give every heading a stable id, a permalink, and a table of contents entry.
     *
     * @return list<array{id: string, title: string, level: int}>
     */
    private function linkHeadings(HTMLElement $body): array
    {
        $toc = [];
        $used = [];

        foreach ($body->querySelectorAll('h2, h3, h4') as $heading) {
            $level = (int) substr($heading->tagName, 1);
            $title = trim($heading->textContent);

            $base = $heading->getAttribute('id') ?: Str::slug($title) ?: 'section';
            $id = $base;
            $suffix = 1;

            while (isset($used[$id])) {
                $id = $base.'-'.(++$suffix);
            }

            $used[$id] = true;

            $heading->setAttribute('id', $id);
            $heading->setAttribute('class', 'group scroll-mt-24');

            $heading->insertAdjacentHTML(AdjacentPosition::BeforeEnd, sprintf(
                '<a href="#%1$s" class="focus-ring ml-2 align-middle text-accent opacity-0 transition group-hover:opacity-100 focus-visible:opacity-100" aria-label="Permalink to %2$s">#</a>',
                htmlspecialchars($id, ENT_QUOTES),
                htmlspecialchars($title, ENT_QUOTES),
            ));

            if (in_array($level, self::TOC_LEVELS, true)) {
                $toc[] = ['id' => $id, 'title' => $title, 'level' => $level];
            }
        }

        return $toc;
    }

    /**
     * Tag "> **Note:**" and "> **Warning:**" blockquotes so they render as callouts.
     */
    private function markCallouts(HTMLElement $body): void
    {
        foreach ($body->querySelectorAll('blockquote') as $quote) {
            $label = $quote->querySelector('strong');

            $tone = $label instanceof Element && Str::contains(Str::lower($label->textContent), 'warning')
                ? 'warning'
                : 'note';

            $quote->setAttribute('data-callout', $tone);
        }
    }

    /**
     * Wrap each code block in a scroller with a language label and a copy button.
     */
    private function wrapCodeBlocks(HTMLDocument $document, HTMLElement $body): void
    {
        foreach (iterator_to_array($body->querySelectorAll('pre')) as $index => $pre) {
            $language = $pre->getAttribute('data-lang') ?: 'code';

            $wrapper = $document->createElement('div');
            $wrapper->setAttribute('data-code-block', '');
            $wrapper->setAttribute('class', 'not-prose group/code relative my-6 overflow-hidden rounded-xl border border-white/10 bg-panel');

            $pre->parentNode?->replaceChild($wrapper, $pre);

            $wrapper->insertAdjacentHTML(AdjacentPosition::AfterBegin, sprintf(
                <<<'HTML'
                <div class="flex items-center justify-between gap-3 border-b border-white/5 py-2 pr-2 pl-4">
                    <span class="font-code text-[11px] tracking-[0.14em] text-zinc-600 uppercase">%s</span>
                    <button type="button" data-copy aria-label="Copy code example %d to clipboard" class="focus-ring shrink-0 rounded-md p-1.5 text-zinc-500 transition hover:bg-white/5 hover:text-white">
                        <svg data-copy-idle class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="9" y="9" width="11" height="11" rx="2"/><path d="M5 15V5a2 2 0 012-2h8"/></svg>
                        <svg data-copy-done class="hidden h-4 w-4 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
                    </button>
                </div>
                HTML,
                htmlspecialchars($language, ENT_QUOTES),
                $index + 1,
            ));

            $wrapper->appendChild($pre);
        }
    }

    /**
     * Give every table its own horizontal scroller.
     *
     * Without this a wide table sets the min-content width of the article and
     * pushes the whole page sideways on a phone.
     */
    private function wrapTables(HTMLDocument $document, HTMLElement $body): void
    {
        foreach (iterator_to_array($body->querySelectorAll('table')) as $table) {
            $wrapper = $document->createElement('div');
            $wrapper->setAttribute('class', 'my-6 -mx-6 overflow-x-auto px-6');

            $table->parentNode?->replaceChild($wrapper, $table);

            $wrapper->appendChild($table);
        }
    }

    /**
     * Serialise the children of an element.
     */
    private function innerHtml(HTMLElement $element): string
    {
        $html = '';

        foreach ($element->childNodes as $child) {
            $html .= $element->ownerDocument->saveHtml($child);
        }

        return $html;
    }

    private function converter(): MarkdownConverter
    {
        if ($this->converter instanceof MarkdownConverter) {
            return $this->converter;
        }

        $environment = new Environment([
            // The docs repository authors raw anchors, images and the odd
            // terminal mock-up directly in markdown.
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);

        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new HighlightExtension(new Highlighter(new CssTheme)));

        return $this->converter = new MarkdownConverter($environment);
    }
}
