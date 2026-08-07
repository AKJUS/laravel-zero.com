@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $base = 'focus-ring inline-flex items-center justify-center gap-2 font-medium transition';

    $sizes = [
        'md' => 'h-11 rounded-xl px-6 text-sm',
        'sm' => 'rounded-lg px-3.5 py-1.5 text-sm',
    ];

    $variants = [
        'primary' => 'bg-white text-surface hover:bg-zinc-200',
        'secondary' => 'border border-white/10 text-zinc-200 hover:border-white/25 hover:bg-white/5',
    ];

    $classes = implode(' ', [$base, $sizes[$size], $variants[$variant]]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
