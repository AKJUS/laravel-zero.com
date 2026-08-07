@props([
    'value' => null,
    'target' => null,
    'label' => 'Copy to clipboard',
])

<button
    type="button"
    data-copy
    @if ($value) data-copy-value="{{ $value }}" @endif
    @if ($target) data-copy-target="{{ $target }}" @endif
    aria-label="{{ $label }}"
    {{ $attributes->merge(['class' => 'focus-ring shrink-0 rounded-md p-1.5 text-zinc-500 transition hover:bg-white/5 hover:text-white']) }}
>
    <x-icons.copy data-copy-idle />
    <x-icons.check class="hidden h-4 w-4 text-accent" data-copy-done />
</button>
