@props([
    'headings',
])

@if ($headings !== [])
    <aside class="hidden w-52 shrink-0 xl:block">
        <nav
            aria-labelledby="on-this-page"
            class="sticky top-16 max-h-[calc(100vh-4rem)] overflow-y-auto py-10"
        >
            <p id="on-this-page" class="font-code text-[11px] tracking-[0.16em] text-zinc-500 uppercase">On this page</p>

            <ul class="mt-4 border-l border-white/10 text-sm">
                @foreach ($headings as $heading)
                    <li>
                        <a
                            href="#{{ $heading['id'] }}"
                            data-toc-link
                            @class([
                                '-ml-px block border-l border-transparent py-1.5 text-zinc-500 transition hover:text-white focus-ring',
                                'pl-4' => $heading['level'] === 2,
                                'pl-7' => $heading['level'] > 2,
                            ])
                        >{{ $heading['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </aside>
@endif
