<footer class="border-t border-white/5">
    <x-container class="flex flex-col gap-6 py-10 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-2.5">
            <x-logo variant="footer" />
            <span class="text-sm text-zinc-500">Laravel Zero — a micro-framework by the community.</span>
        </div>

        <nav aria-label="Footer" class="flex gap-6 text-sm text-zinc-500">
            <a href="{{ route('docs') }}" class="focus-ring rounded transition hover:text-white">Docs</a>
            <a href="https://github.com/laravel-zero/laravel-zero" class="focus-ring rounded transition hover:text-white">GitHub</a>
            <a href="https://discord.gg/laravel-zero" class="focus-ring rounded transition hover:text-white">Discord</a>
            <a href="{{ route('designs.index') }}" class="focus-ring rounded transition hover:text-white">All designs</a>
        </nav>
    </x-container>
</footer>
