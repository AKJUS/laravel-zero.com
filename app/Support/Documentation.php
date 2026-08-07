<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/**
 * Reads the documentation markdown that "bin/checkout_latest_docs.sh" pulls
 * into "resources/docs/{version}" and turns it into pages and navigation.
 */
final class Documentation
{
    /**
     * The markdown file that defines the sidebar order and grouping.
     */
    private const INDEX = 'documentation';

    public function __construct(
        private readonly Filesystem $filesystem,
        private readonly Cache $cache,
        private readonly DocumentationRenderer $renderer,
    ) {}

    public function version(): string
    {
        return (string) config('docs.version');
    }

    /**
     * Determine whether a page can be rendered.
     */
    public function exists(string $slug): bool
    {
        if (in_array(Str::lower($slug), (array) config('docs.excluded'), true)) {
            return false;
        }

        // Guard against traversal: slugs map directly onto file names.
        if (Str::slug($slug) !== $slug) {
            return false;
        }

        return $this->filesystem->exists($this->path("{$slug}.md"));
    }

    /**
     * The grouped sidebar navigation, in authored order.
     *
     * @return list<array{title: string, items: list<array{title: string, slug: string}>}>
     */
    public function navigation(): array
    {
        return $this->remember('navigation', function (): array {
            $path = $this->path(self::INDEX.'.md');

            if (! $this->filesystem->exists($path)) {
                return [];
            }

            $groups = [];
            $current = null;

            foreach (preg_split('/\R/', $this->filesystem->get($path)) as $line) {
                $line = trim($line);

                if (preg_match('/^-\s*#{2,3}\s*(.+)$/', $line, $matches) === 1) {
                    if ($current !== null) {
                        $groups[] = $current;
                    }

                    $current = ['title' => trim($matches[1]), 'items' => []];

                    continue;
                }

                if ($current === null) {
                    continue;
                }

                if (preg_match('/^-\s*\[(.+?)\]\(\/docs\/(.+?)\)/', $line, $matches) === 1) {
                    $current['items'][] = ['title' => trim($matches[1]), 'slug' => trim($matches[2])];
                }
            }

            if ($current !== null) {
                $groups[] = $current;
            }

            return array_values(array_filter($groups, fn (array $group): bool => $group['items'] !== []));
        });
    }

    /**
     * Every navigable page, flattened into reading order.
     *
     * @return list<array{title: string, slug: string}>
     */
    public function pages(): array
    {
        $pages = [];

        foreach ($this->navigation() as $group) {
            foreach ($group['items'] as $item) {
                $pages[] = $item;
            }
        }

        return $pages;
    }

    /**
     * The page that comes before and after the given slug in reading order.
     *
     * @return array{previous: array{title: string, slug: string}|null, next: array{title: string, slug: string}|null}
     */
    public function neighbours(string $slug): array
    {
        $pages = $this->pages();
        $index = null;

        foreach ($pages as $position => $page) {
            if ($page['slug'] === $slug) {
                $index = $position;

                break;
            }
        }

        if ($index === null) {
            return ['previous' => null, 'next' => null];
        }

        return [
            'previous' => $pages[$index - 1] ?? null,
            'next' => $pages[$index + 1] ?? null,
        ];
    }

    /**
     * When the markdown behind a page last changed, for sitemaps and linked data.
     */
    public function lastModified(string $slug): CarbonImmutable
    {
        return CarbonImmutable::createFromTimestamp(
            $this->filesystem->lastModified($this->path("{$slug}.md")),
        );
    }

    public function page(string $slug): DocumentationPage
    {
        $path = $this->path("{$slug}.md");

        $rendered = $this->remember(
            "page.{$slug}.".$this->filesystem->lastModified($path),
            function () use ($path): array {
                $document = YamlFrontMatter::parse($this->filesystem->get($path));
                $matter = $document->matter();

                return [
                    'matter' => $matter,
                    'rendered' => $this->renderer->render($document->body()),
                ];
            },
        );

        /** @var array{title?: string, description?: string} $matter */
        $matter = $rendered['matter'];

        /** @var array{title: string|null, contents: string, toc: list<array{id: string, title: string, level: int}>} $body */
        $body = $rendered['rendered'];

        return new DocumentationPage(
            slug: $slug,
            title: $matter['title'] ?? $body['title'] ?? Str::headline($slug),
            description: $matter['description'] ?? null,
            contents: $body['contents'],
            tableOfContents: $body['toc'],
            lastModified: $this->lastModified($slug),
        );
    }

    /**
     * @template TValue
     *
     * @param  Closure(): TValue  $callback
     * @return TValue
     */
    private function remember(string $key, Closure $callback): mixed
    {
        return $this->cache->remember("docs.{$this->version()}.{$key}", now()->addMinutes(5), $callback);
    }

    private function path(string $file): string
    {
        return resource_path("docs/{$this->version()}/{$file}");
    }
}
