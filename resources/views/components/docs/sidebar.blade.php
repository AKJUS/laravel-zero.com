@props([
    'navigation',
    'current',
])

<aside class="hidden w-56 shrink-0 lg:block">
    <nav
        aria-label="Documentation"
        class="sticky top-16 max-h-[calc(100vh-4rem)] overflow-y-auto py-10 pr-4"
    >
        <x-docs.nav :navigation="$navigation" :current="$current" />
    </nav>
</aside>
