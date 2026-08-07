@php
    $links = [
        ['label' => 'Features', 'href' => route('home').'#features', 'active' => false],
        ['label' => 'Build', 'href' => route('home').'#build', 'active' => false],
        ['label' => 'Add-ons', 'href' => route('home').'#addons', 'active' => false],
        ['label' => 'Documentation', 'href' => route('docs'), 'active' => request()->routeIs('docs')],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-white/5 bg-surface/80 backdrop-blur-xl">
    <x-container class="flex h-16 items-center justify-between gap-6">
        <a href="{{ route('home') }}" class="focus-ring flex items-center gap-2.5 rounded-lg">
            <x-logo />
            <span class="text-[15px] font-semibold tracking-tight text-white">Laravel Zero</span>
            <span class="sr-only">— home</span>
        </a>

        <nav aria-label="Primary" class="hidden items-center gap-7 text-sm text-zinc-400 md:flex">
            @foreach ($links as $link)
                <a
                    href="{{ $link['href'] }}"
                    @class(['focus-ring rounded transition hover:text-white', 'text-white' => $link['active']])
                    @if ($link['active']) aria-current="page" @endif
                >{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            <a
                href="https://github.com/laravel-zero/laravel-zero"
                class="focus-ring hidden items-center gap-2 rounded-lg border border-white/10 px-3 py-1.5 text-sm text-zinc-300 transition hover:border-white/25 hover:text-white sm:inline-flex"
            >
                <x-icons.github />
                GitHub
            </a>

            <x-button size="sm" :href="route('home').'#install'">Get started</x-button>
        </div>
    </x-container>
</header>
