@props([
    'path' => null,
    'shadow' => 'shadow-2xl shadow-black/60',
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-2xl border border-white/10 bg-panel '.$shadow]) }}>
    <div class="flex items-center gap-2 border-b border-white/5 px-4 py-3">
        <span class="h-2.5 w-2.5 rounded-full bg-terminal-close"></span>
        <span class="h-2.5 w-2.5 rounded-full bg-terminal-minimise"></span>
        <span class="h-2.5 w-2.5 rounded-full bg-terminal-expand"></span>

        @if ($path)
            <span class="font-code ml-3 text-xs text-zinc-600">{{ $path }}</span>
        @endif
    </div>

    <div class="font-code overflow-x-auto p-5 text-[13px] leading-relaxed">
        {{ $slot }}
    </div>
</div>
