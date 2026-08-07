@props([
    'previous' => null,
    'next' => null,
])

@if ($previous || $next)
    <nav aria-label="Pagination" class="mt-16 grid gap-4 border-t border-white/5 pt-10 sm:grid-cols-2">
        @if ($previous)
            <a
                href="{{ route('docs', $previous['slug']) }}"
                rel="prev"
                class="focus-ring group flex min-w-0 flex-col gap-1 rounded-xl border border-white/10 bg-white/[0.02] p-4 transition hover:border-white/25 hover:bg-white/[0.04]"
            >
                <span class="flex items-center gap-1.5 font-code text-[11px] tracking-[0.16em] text-zinc-600 uppercase">
                    <x-icons.arrow-left class="h-3 w-3" />
                    Previous
                </span>
                <span class="truncate text-sm font-medium text-zinc-200 transition group-hover:text-white">{{ $previous['title'] }}</span>
            </a>
        @else
            <span class="hidden sm:block"></span>
        @endif

        @if ($next)
            <a
                href="{{ route('docs', $next['slug']) }}"
                rel="next"
                class="focus-ring group flex min-w-0 flex-col items-end gap-1 rounded-xl border border-white/10 bg-white/[0.02] p-4 text-right transition hover:border-white/25 hover:bg-white/[0.04]"
            >
                <span class="flex items-center gap-1.5 font-code text-[11px] tracking-[0.16em] text-zinc-600 uppercase">
                    Next
                    <x-icons.arrow-right class="h-3 w-3" />
                </span>
                <span class="w-full truncate text-sm font-medium text-zinc-200 transition group-hover:text-white">{{ $next['title'] }}</span>
            </a>
        @endif
    </nav>
@endif
