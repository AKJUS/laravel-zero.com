@props([
    'filename' => null,
    'shadow' => 'shadow-2xl shadow-black/50',
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-2xl border border-white/10 bg-panel '.$shadow]) }}>
    @if ($filename)
        <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
            <span class="font-code rounded-md bg-white/5 px-2 py-1 text-xs text-zinc-300">{{ $filename }}</span>
        </div>
    @endif

    {{ $slot }}
</div>
