<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>Laravel Zero — Design directions</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&family=jetbrains-mono:400,500" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-display { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            .font-code { font-family: 'JetBrains Mono', ui-monospace, monospace; }
        </style>
    </head>
    <body class="font-display min-h-screen bg-[#FDFDFC] text-[#1b1b18] antialiased">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <p class="font-code text-xs tracking-[0.18em] text-[#706f6c] uppercase">laravel-zero.com</p>
            <h1 class="mt-5 text-4xl font-semibold tracking-[-0.02em] sm:text-5xl">Four design directions</h1>
            <p class="mt-4 max-w-xl leading-relaxed text-[#4a4a46]">
                Each is a complete, standalone landing page. Open them side by side and pick the voice that fits.
            </p>

            <div class="mt-14 grid gap-5 sm:grid-cols-2">
                @php
                    $designs = [
                        ['Midnight', 'designs.midnight', 'Dark, product-grade minimalism. Vercel-adjacent: hairline grid, restrained emerald accent, a hero terminal doing real work.', '#08090A', '#34D399'],
                        ['Editorial', 'designs.editorial', 'Warm and typographic, in the spirit of laravel.com. Instrument Serif headlines, the familiar red accent, generous whitespace.', '#FDFDFC', '#f53003'],
                        ['Prism', 'designs.prism', 'Playful and colourful, in the spirit of pestphp.com. Violet-to-amber gradients, soft glows, a bento feature grid.', '#120C1F', '#E879F9'],
                        ['Blueprint', 'designs.blueprint', 'Swiss and structural. Monospace labels, numbered sections, hairline rules, dense tables, one electric blue.', '#FFFFFF', '#0032FF'],
                    ];
                @endphp

                @foreach ($designs as [$name, $route, $body, $bg, $accent])
                    <a href="{{ route($route) }}" class="group flex flex-col overflow-hidden rounded-lg border border-[#1914001a] bg-white transition hover:border-[#19140040] hover:shadow-lg">
                        <span class="flex h-28 items-center gap-3 px-8" style="background-color: {{ $bg }}">
                            <span class="h-10 w-10 rounded-full" style="background-color: {{ $accent }}"></span>
                            <span class="h-10 flex-1 rounded" style="background-color: {{ $accent }}1a"></span>
                        </span>
                        <span class="flex flex-1 flex-col p-7">
                            <span class="flex items-center justify-between">
                                <span class="text-lg font-semibold tracking-[-0.01em]">{{ $name }}</span>
                                <span class="font-code text-xs text-[#706f6c]">/designs/{{ strtolower($name) }}</span>
                            </span>
                            <span class="mt-3 text-sm leading-relaxed text-[#706f6c]">{{ $body }}</span>
                            <span class="mt-6 inline-flex items-center gap-1.5 text-sm font-medium" style="color: {{ $accent === '#FFFFFF' ? '#1b1b18' : $accent }}">
                                View design
                                <svg viewBox="0 0 12 12" class="h-3 w-3 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4.5 2.5L8 6l-3.5 3.5"/></svg>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </body>
</html>
