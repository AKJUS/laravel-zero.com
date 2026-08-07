@php
    use App\Support\Seo;

    // The sidebar group the page sits in, so the breadcrumb mirrors the
    // navigation a reader actually used to get here.
    $group = collect($navigation)
        ->first(fn (array $group): bool => collect($group['items'])->contains('slug', $page->slug));

    $crumbs = array_values(array_filter([
        ['name' => 'Documentation', 'item' => Seo::url('docs/'.config('docs.default_page'))],
        $group ? ['name' => $group['title'], 'item' => null] : null,
        ['name' => $page->title, 'item' => Seo::url('docs/'.$page->slug)],
    ]));

    $schema = [
        [
            '@type' => 'TechArticle',
            '@id' => Seo::url('docs/'.$page->slug.'#article'),
            'headline' => $page->title,
            'name' => $page->title,
            'description' => $page->description,
            'url' => Seo::url('docs/'.$page->slug),
            'inLanguage' => 'en',
            'isPartOf' => ['@id' => Seo::url('#website')],
            'publisher' => ['@id' => Seo::url('#organization')],
            // Declared inline rather than referenced: the full software node
            // only exists in the landing page's graph.
            'about' => [
                '@type' => 'SoftwareApplication',
                '@id' => Seo::url('#software'),
                'name' => config('seo.site_name'),
                'url' => Seo::url(),
            ],
            'articleSection' => $group['title'] ?? 'Documentation',
            'dateModified' => $page->lastModified->toIso8601String(),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => Seo::url('docs/'.$page->slug.'#breadcrumb'),
            'itemListElement' => collect($crumbs)
                ->map(fn (array $crumb, int $index): array => array_filter([
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $crumb['name'],
                    'item' => $crumb['item'],
                ]))
                ->all(),
        ],
    ];
@endphp

<x-layouts.app
    :title="$page->title"
    :description="$page->description"
    type="article"
    :schema="$schema"
>
    {{-- Mobile chrome: drawer toggle and current page, pinned under the site nav. --}}
    <div class="sticky top-16 z-40 border-b border-white/5 bg-surface/80 backdrop-blur-xl lg:hidden">
        <x-container class="flex h-12 items-center justify-between gap-3">
            <button
                type="button"
                data-drawer-toggle
                aria-expanded="false"
                aria-controls="docs-drawer"
                class="focus-ring -ml-1.5 inline-flex items-center gap-2 rounded-md px-1.5 py-1 text-sm text-zinc-300 transition hover:text-white"
            >
                <x-icons.menu class="h-4 w-4" />
                Documentation
            </button>

            <span class="min-w-0 truncate font-code text-xs text-zinc-600">{{ $page->title }}</span>
        </x-container>
    </div>

    <x-docs.drawer :navigation="$navigation" :current="$page->slug" />

    <x-container class="lg:flex lg:gap-10">
        <x-docs.sidebar :navigation="$navigation" :current="$page->slug" />

        <div class="min-w-0 flex-1 xl:flex xl:gap-10">
            <article class="min-w-0 flex-1 py-10 lg:py-14">
                <header>
                    <x-eyebrow>Documentation</x-eyebrow>

                    <h1 class="mt-4 text-3xl font-semibold tracking-[-0.02em] text-white text-balance sm:text-4xl">
                        {{ $page->title }}
                    </h1>

                    @if ($page->description)
                        <p class="mt-4 text-lg leading-relaxed text-zinc-400 text-pretty">{{ $page->description }}</p>
                    @endif
                </header>

                {{-- Table of contents, collapsed on the widths where the rail is hidden. --}}
                @if ($page->tableOfContents !== [])
                    <details class="group/toc mt-8 rounded-xl border border-white/10 bg-white/[0.02] xl:hidden">
                        <summary class="focus-ring flex cursor-pointer list-none items-center justify-between gap-3 rounded-xl px-4 py-3 text-sm text-zinc-300 [&::-webkit-details-marker]:hidden">
                            <span class="flex items-center gap-2">
                                <x-icons.list class="h-4 w-4 text-zinc-600" />
                                On this page
                            </span>
                            <svg viewBox="0 0 12 12" class="h-3 w-3 shrink-0 text-zinc-600 transition group-open/toc:rotate-90" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path d="M4.5 2.5L8 6l-3.5 3.5"/>
                            </svg>
                        </summary>

                        <ul class="border-t border-white/5 px-4 py-3 text-sm">
                            @foreach ($page->tableOfContents as $heading)
                                <li>
                                    <a
                                        href="#{{ $heading['id'] }}"
                                        @class([
                                            'focus-ring block rounded py-1.5 text-zinc-400 transition hover:text-white',
                                            'pl-3' => $heading['level'] > 2,
                                        ])
                                    >{{ $heading['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </details>
                @endif

                <div class="docs-prose mt-10">
                    {!! $page->contents !!}
                </div>

                <x-docs.pager :previous="$neighbours['previous']" :next="$neighbours['next']" />

                <p class="mt-10 text-sm text-zinc-600">
                    Spotted a mistake?
                    <a
                        href="https://github.com/laravel-zero/docs/edit/{{ config('docs.version') }}/{{ $page->slug }}.md"
                        class="focus-ring rounded text-zinc-400 underline decoration-white/20 underline-offset-4 transition hover:text-white hover:decoration-white/40"
                    >Edit this page on GitHub</a>.
                </p>
            </article>

            <x-docs.toc :headings="$page->tableOfContents" />
        </div>
    </x-container>
</x-layouts.app>
