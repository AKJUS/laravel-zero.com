@props([
    'title',
    'icon',
])

<div {{ $attributes->merge(['class' => 'group bg-surface p-8 transition hover:bg-panel']) }}>
    <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-accent transition group-hover:border-accent/30">
        <svg viewBox="0 0 24 24" class="h-4.5 w-4.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="{{ $icon }}"/>
        </svg>
    </span>

    <h3 class="mt-5 text-base font-semibold text-white">{{ $title }}</h3>
    <p class="mt-2 text-sm leading-relaxed text-zinc-400">{{ $slot }}</p>
</div>
