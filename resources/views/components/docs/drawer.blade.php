@props([
    'navigation',
    'current',
])

{{-- Mobile navigation. Closed state is inert so it stays out of the tab order. --}}
<div
    id="docs-drawer"
    inert
    class="pointer-events-none fixed inset-0 z-60 opacity-0 transition-opacity duration-200 lg:hidden"
>
    <div data-drawer-dismiss class="absolute inset-0 bg-black/70"></div>

    <div
        data-drawer-panel
        class="absolute inset-y-0 left-0 flex w-80 max-w-[85vw] -translate-x-full flex-col border-r border-white/10 bg-surface transition-transform duration-200"
    >
        <div class="flex h-16 shrink-0 items-center justify-between gap-3 border-b border-white/5 px-5">
            <span class="font-code text-[11px] tracking-[0.16em] text-zinc-500 uppercase">Documentation</span>

            <button
                type="button"
                data-drawer-dismiss
                aria-label="Close navigation"
                class="focus-ring rounded-md p-1.5 text-zinc-500 transition hover:bg-white/5 hover:text-white"
            >
                <x-icons.close />
            </button>
        </div>

        <nav aria-label="Documentation (mobile)" class="min-h-0 flex-1 overflow-y-auto px-5 py-6">
            <x-docs.nav :navigation="$navigation" :current="$current" />
        </nav>
    </div>
</div>
