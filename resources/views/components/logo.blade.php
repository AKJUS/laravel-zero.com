@props([
    'variant' => 'nav',
])

@php
    $sizes = [
        'nav' => 'h-8 w-8',
        'footer' => 'h-7 w-7',
    ];

    // The gradient id must be unique: the mark renders more than once per page.
    $gradient = 'laravel-zero-mark-'.Str::random(8);
@endphp

{{-- The original Laravel Zero mark, from laravel-zero.com/assets/img/logo.svg. --}}
<svg
    {{ $attributes->merge(['class' => 'shrink-0 '.$sizes[$variant]]) }}
    viewBox="0 0 56 56"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
>
    <path
        d="M48 13.4L56 5.4V4C56 1.8 54.2 0 52 0H4C1.8 0 0 1.8 0 4V42.6L8 34.6V8H42.6L16 34.6L8 42.6L0 50.6V52C0 54.2 1.8 56 4 56H52C54.2 56 56 54.2 56 52V13.4L48 21.4V48H13.4L33.3 28.1L48 13.4V13.4Z"
        fill="url(#{{ $gradient }})"
    />
    <defs>
        <linearGradient id="{{ $gradient }}" x1="28" y1="0" x2="28" y2="56" gradientUnits="userSpaceOnUse">
            <stop stop-color="#68BF66"/>
            <stop offset="1" stop-color="#42B257"/>
        </linearGradient>
    </defs>
</svg>
