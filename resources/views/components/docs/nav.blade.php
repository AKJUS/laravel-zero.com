@props([
    'navigation',
    'current',
])

{{-- Shared by the desktop sidebar and the mobile drawer. --}}
<ul {{ $attributes->merge(['class' => 'space-y-6']) }}>
    @foreach ($navigation as $group)
        <li>
            <details open class="group/group">
                <summary class="focus-ring flex cursor-pointer list-none items-center justify-between gap-2 rounded py-1 font-code text-[11px] tracking-[0.16em] text-zinc-500 uppercase transition hover:text-zinc-300 [&::-webkit-details-marker]:hidden">
                    {{ $group['title'] }}
                    <svg viewBox="0 0 12 12" class="h-3 w-3 shrink-0 transition group-open/group:rotate-90" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M4.5 2.5L8 6l-3.5 3.5"/>
                    </svg>
                </summary>

                <ul class="mt-3 border-l border-white/10">
                    @foreach ($group['items'] as $item)
                        @php($active = $item['slug'] === $current)

                        <li>
                            <a
                                href="{{ route('docs', $item['slug']) }}"
                                @class([
                                    'focus-ring -ml-px block border-l py-1.5 pl-4 text-sm transition',
                                    'border-accent font-medium text-white' => $active,
                                    'border-transparent text-zinc-400 hover:border-white/30 hover:text-white' => ! $active,
                                ])
                                @if ($active) aria-current="page" @endif
                            >{{ $item['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </details>
        </li>
    @endforeach
</ul>
