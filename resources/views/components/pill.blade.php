@props([
    'href' => null,
    'chip' => null,
])

@php
    $classes = 'focus-ring inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 py-1 pr-3 pl-1 text-xs text-zinc-400 transition hover:border-white/20 hover:text-zinc-200';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($chip)
            <span class="rounded-full bg-accent/15 px-2 py-0.5 font-medium text-accent-strong">{{ $chip }}</span>
        @endif
        {{ $slot }}
    </a>
@else
    <span {{ $attributes->merge(['class' => $classes]) }}>
        @if ($chip)
            <span class="rounded-full bg-accent/15 px-2 py-0.5 font-medium text-accent-strong">{{ $chip }}</span>
        @endif
        {{ $slot }}
    </span>
@endif
