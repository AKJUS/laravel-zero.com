@props([
    'title' => null,
    'description' => null,
    'type' => 'website',
    'indexable' => true,
    'schema' => [],
])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <x-seo
            :title="$title"
            :description="$description"
            :type="$type"
            :indexable="$indexable"
            :schema="$schema"
        />

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-display bg-surface text-zinc-300 antialiased selection:bg-emerald-300 selection:text-black">
        <a
            href="#main"
            class="focus-ring sr-only rounded-lg bg-white px-4 py-2 text-sm font-medium text-surface focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-100"
        >Skip to content</a>

        <x-site-nav />

        <main id="main">
            {{ $slot }}
        </main>

        <x-site-footer />
    </body>
</html>
