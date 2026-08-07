@props([
    'eyebrow' => null,
    'title',
    'size' => 'md',
])

@php
    $headingSize = $size === 'lg' ? 'text-4xl sm:text-5xl' : 'text-4xl';
    $leadSize = $size === 'lg' ? 'text-lg' : '';
@endphp

{{-- No default max-width: the measure is the caller's decision, and merging
     two conflicting max-w-* utilities would resolve by stylesheet order. --}}
<div {{ $attributes }}>
    @if ($eyebrow)
        <x-eyebrow>{{ $eyebrow }}</x-eyebrow>
    @endif

    <h2 @class(['mt-4 font-semibold tracking-[-0.02em] text-white text-balance', $headingSize])>{{ $title }}</h2>

    @if (trim($slot) !== '')
        <p @class(['mt-5 leading-relaxed text-zinc-400 text-pretty', $leadSize])>{{ $slot }}</p>
    @endif
</div>
