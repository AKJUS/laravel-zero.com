<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>Laravel Zero — It's a wonderful day for shipping a CLI</title>
        <meta name="description" content="Laravel Zero is a micro-framework for building console applications on top of Laravel's components.">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800|jetbrains-mono:400,500,700" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-display { font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif; }
            .font-code { font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace; }

            .gradient-text {
                background-image: linear-gradient(100deg, #C084FC 0%, #F472B6 42%, #FBBF24 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            @keyframes zero-float { 0%, 100% { transform: translateY(0) } 50% { transform: translateY(-10px) } }
            .float-slow { animation: zero-float 7s ease-in-out infinite; }
            .float-slower { animation: zero-float 9s ease-in-out infinite; }

            @keyframes zero-in { from { opacity: 0; transform: translateY(18px) } to { opacity: 1; transform: none } }
            .fade-up { animation: zero-in .8s cubic-bezier(.16,1,.3,1) both; }
        </style>
    </head>
    <body class="font-display bg-[#120C1F] text-violet-100/80 antialiased selection:bg-fuchsia-400 selection:text-[#120C1F]">

        {{-- Nav --}}
        <header class="sticky top-0 z-50 border-b border-white/[0.06] bg-[#120C1F]/75 backdrop-blur-xl">
            <div class="mx-auto flex h-[70px] max-w-6xl items-center justify-between gap-6 px-6">
                <a href="#" class="flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-2xl bg-linear-to-br from-violet-400 via-fuchsia-400 to-amber-300 text-[#120C1F] shadow-lg shadow-fuchsia-500/25">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 7l4 4-4 4M12 16h7"/></svg>
                    </span>
                    <span class="text-[15px] font-bold tracking-tight text-white">Laravel Zero</span>
                </a>

                <nav class="hidden items-center gap-8 text-sm font-medium text-violet-200/60 md:flex">
                    <a href="#joy" class="transition hover:text-white">Why</a>
                    <a href="#bento" class="transition hover:text-white">Features</a>
                    <a href="#code" class="transition hover:text-white">Code</a>
                    <a href="#" class="transition hover:text-white">Docs</a>
                </nav>

                <a href="#install" class="rounded-full bg-linear-to-r from-violet-400 via-fuchsia-400 to-amber-300 px-5 py-2 text-sm font-semibold text-[#120C1F] transition hover:brightness-110">
                    Get started
                </a>
            </div>
        </header>

        {{-- Hero --}}
        <section class="relative overflow-hidden">
            <div class="float-slow pointer-events-none absolute -top-32 -left-24 h-[440px] w-[440px] rounded-full bg-violet-600/25 blur-[110px]"></div>
            <div class="float-slower pointer-events-none absolute -top-20 right-0 h-[420px] w-[420px] rounded-full bg-fuchsia-500/20 blur-[120px]"></div>
            <div class="pointer-events-none absolute top-64 left-1/3 h-[320px] w-[320px] rounded-full bg-amber-400/10 blur-[110px]"></div>

            <div class="relative mx-auto max-w-4xl px-6 pt-24 pb-20 text-center sm:pt-32">
                <span class="fade-up inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-medium text-violet-200/80">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-fuchsia-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-fuchsia-400"></span>
                    </span>
                    Version 12 is out — built on Laravel 12
                </span>

                <h1 class="fade-up mt-8 text-4xl leading-[1.1] font-extrabold tracking-[-0.03em] text-white text-balance sm:text-6xl sm:leading-[1.06] lg:text-7xl" style="animation-delay:.08s">
                    It's a wonderful day<br class="hidden sm:inline"> for <span class="gradient-text">shipping a CLI.</span>
                </h1>

                <p class="fade-up mx-auto mt-7 max-w-2xl text-lg leading-relaxed text-violet-200/70 text-pretty sm:text-xl" style="animation-delay:.16s">
                    Laravel Zero is a micro-framework for console applications. All the elegance of Laravel,
                    none of the web — and a single binary at the end of it.
                </p>

                <div class="fade-up mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row" style="animation-delay:.24s">
                    <a href="#" class="inline-flex h-12 items-center justify-center rounded-full bg-linear-to-r from-violet-400 via-fuchsia-400 to-amber-300 px-7 text-sm font-bold text-[#120C1F] shadow-lg shadow-fuchsia-500/25 transition hover:brightness-110">
                        Start building
                    </a>
                    <a href="#code" class="inline-flex h-12 items-center justify-center gap-2 rounded-full border border-white/15 bg-white/5 px-7 text-sm font-semibold text-white transition hover:bg-white/10">
                        See the code
                    </a>
                </div>

                <div id="install" class="fade-up mx-auto mt-10 flex max-w-xl items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-5 py-4 backdrop-blur" style="animation-delay:.32s">
                    <span class="font-code text-sm text-fuchsia-300 select-none">$</span>
                    <code class="font-code min-w-0 flex-1 truncate text-left text-sm text-violet-50">composer create-project laravel-zero/laravel-zero my-cli</code>
                    <button type="button" class="shrink-0 rounded-lg p-1.5 text-violet-200/50 transition hover:bg-white/10 hover:text-white" aria-label="Copy install command">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="11" height="11" rx="2"/><path d="M5 15V5a2 2 0 012-2h8"/></svg>
                    </button>
                </div>
            </div>
        </section>

        {{-- Floating terminal --}}
        <div class="relative z-10 mx-auto -mb-24 max-w-3xl px-6">
                <div class="fade-up overflow-hidden rounded-3xl border border-white/10 bg-[#181129] shadow-2xl shadow-violet-950/60" style="animation-delay:.4s">
                    <div class="flex items-center gap-2 border-b border-white/[0.07] px-5 py-3.5">
                        <span class="h-3 w-3 rounded-full bg-violet-400/60"></span>
                        <span class="h-3 w-3 rounded-full bg-fuchsia-400/60"></span>
                        <span class="h-3 w-3 rounded-full bg-amber-300/60"></span>
                    </div>
                    <div class="font-code overflow-x-auto p-6 text-[13px] leading-relaxed">
                        <p class="whitespace-nowrap"><span class="text-fuchsia-300">❯</span> <span class="text-violet-50">php my-cli release --patch</span></p>
                        <p class="mt-4 whitespace-nowrap text-violet-200/50">◐ Bumping version <span class="text-violet-200/25">................</span> <span class="text-emerald-300">1.4.2</span></p>
                        <p class="whitespace-nowrap text-violet-200/50">◐ Compiling PHAR <span class="text-violet-200/25">.................</span> <span class="text-emerald-300">4.1 MB</span></p>
                        <p class="whitespace-nowrap text-violet-200/50">◐ Signing artifact <span class="text-violet-200/25">...............</span> <span class="text-emerald-300">OK</span></p>
                        <p class="mt-4 whitespace-nowrap"><span class="rounded-md bg-emerald-400/15 px-2 py-0.5 text-emerald-300">DONE</span> <span class="text-violet-100">Released in 3.02s — go make a coffee. ☕</span></p>
                    </div>
                </div>
        </div>

        {{-- Joy strip --}}
        <section id="joy" class="border-y border-white/[0.06] bg-white/[0.02] pt-40 pb-20">
            <div class="mx-auto grid max-w-5xl gap-10 px-6 text-center sm:grid-cols-3">
                @php
                    $stats = [
                        ['One file', 'Your entire app compiles into a single executable PHAR.'],
                        ['Zero web', 'No routing, no sessions, no views — just the console kernel.'],
                        ['All Laravel', 'The container, the collections, the ecosystem you already love.'],
                    ];
                @endphp
                @foreach ($stats as [$title, $body])
                    <div>
                        <p class="gradient-text text-3xl font-extrabold tracking-tight">{{ $title }}</p>
                        <p class="mx-auto mt-3 max-w-xs text-sm leading-relaxed text-violet-200/60">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Bento --}}
        <section id="bento" class="mx-auto max-w-6xl px-6 py-24">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-4xl font-extrabold tracking-[-0.02em] text-white text-balance sm:text-5xl">
                    Delightful by default.
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-violet-200/65 text-pretty">
                    The boring parts are already done, so you can spend the afternoon on the fun ones.
                </p>
            </div>

            <div class="mt-14 grid gap-5 lg:grid-cols-3">
                {{-- Large card --}}
                <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-linear-to-br from-violet-500/15 to-fuchsia-500/5 p-8 lg:col-span-2">
                    <div class="pointer-events-none absolute -top-24 -right-16 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
                    <h3 class="relative text-2xl font-bold text-white">Beautiful terminal output</h3>
                    <p class="relative mt-3 max-w-md leading-relaxed text-violet-200/70">
                        Termwind lets you style the console with the utility classes you already know. Tasks, tables,
                        spinners and progress bars are one method call away.
                    </p>
                    <div class="font-code relative mt-7 overflow-x-auto rounded-2xl border border-white/10 bg-[#0F0A19]/80 p-5 text-[13px] leading-relaxed">
                        <p class="whitespace-nowrap text-violet-200/60">render(<span class="text-emerald-300">'&lt;div class="px-2 bg-fuchsia-400"&gt;Shipped!&lt;/div&gt;'</span>);</p>
                        <p class="mt-4"><span class="rounded bg-fuchsia-400 px-2 py-0.5 font-semibold text-[#120C1F]">Shipped!</span></p>
                    </div>
                </div>

                {{-- Small card --}}
                <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-8">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-300/15 text-amber-300">
                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L4.5 13.5H11l-1 8.5L19.5 10H13z"/></svg>
                    </span>
                    <h3 class="mt-5 text-xl font-bold text-white">Instant scaffolding</h3>
                    <p class="mt-3 leading-relaxed text-violet-200/70">
                        A working application, a first command and a passing test suite — in the time it takes Composer
                        to finish.
                    </p>
                </div>

                @php
                    $cards = [
                        ['Pest, pre-installed', 'Write expressive tests for your commands from the very first commit — expectations, datasets and all.', 'M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z', 'emerald'],
                        ['Scheduling built in', 'Attach a cron expression to any command and let one crontab entry run your whole application.', 'M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'violet'],
                        ['Ship a single binary', 'app:build compiles everything into one PHAR. Upload it, curl it, brew it — your users just run it.', 'M12 3v12m0 0l-4-4m4 4l4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2', 'fuchsia'],
                    ];
                @endphp
                @foreach ($cards as [$title, $body, $path, $tone])
                    <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-8 transition hover:border-white/20 hover:bg-white/[0.05]">
                        <span @class([
                            'flex h-11 w-11 items-center justify-center rounded-2xl',
                            'bg-emerald-400/15 text-emerald-300' => $tone === 'emerald',
                            'bg-violet-400/15 text-violet-300' => $tone === 'violet',
                            'bg-fuchsia-400/15 text-fuchsia-300' => $tone === 'fuchsia',
                        ])>
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $path }}"/></svg>
                        </span>
                        <h3 class="mt-5 text-xl font-bold text-white">{{ $title }}</h3>
                        <p class="mt-3 leading-relaxed text-violet-200/70">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Code --}}
        <section id="code" class="border-y border-white/[0.06] bg-white/[0.02]">
            <div class="mx-auto grid max-w-6xl items-center gap-14 px-6 py-24 lg:grid-cols-2">
                <div>
                    <h2 class="text-4xl font-extrabold tracking-[-0.02em] text-white text-balance">
                        You already know<br><span class="gradient-text">how to write this.</span>
                    </h2>
                    <p class="mt-6 leading-relaxed text-violet-200/70 text-pretty">
                        If you have written an Artisan command, you have written a Laravel Zero command. Same signature
                        syntax, same output helpers, same container — with a much smaller surface area around it.
                    </p>
                    <ul class="mt-8 space-y-3 text-sm">
                        @foreach (['Dependency injection in handle()', 'Prompts, confirmations and choices', 'Exit codes as first-class citizens', 'Scheduling next to the command'] as $item)
                            <li class="flex items-center gap-3">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-400/15 text-emerald-300">
                                    <svg viewBox="0 0 20 20" class="h-3 w-3" fill="currentColor"><path d="M8.3 13.6L5 10.3l1.2-1.2 2.1 2.1 5.5-5.5L15 6.9z"/></svg>
                                </span>
                                <span class="text-violet-100/80">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="overflow-hidden rounded-3xl border border-white/10 bg-[#181129]/90 shadow-2xl shadow-violet-950/50">
                    <div class="flex items-center gap-3 border-b border-white/[0.07] px-5 py-3">
                        <span class="font-code rounded-lg bg-white/5 px-2.5 py-1 text-xs text-violet-200/70">tests/Feature/ReleaseTest.php</span>
                    </div>
<pre class="font-code overflow-x-auto p-6 text-[13px] leading-relaxed text-violet-100/85"><span class="text-violet-300/50">&lt;?php</span>

<span class="text-fuchsia-300">it</span>(<span class="text-emerald-300">'releases a patch version'</span>, <span class="text-fuchsia-300">function</span> () {
    $this-&gt;<span class="text-sky-300">artisan</span>(<span class="text-emerald-300">'release --patch'</span>)
        -&gt;<span class="text-sky-300">expectsOutputToContain</span>(<span class="text-emerald-300">'Compiling PHAR'</span>)
        -&gt;<span class="text-sky-300">assertExitCode</span>(<span class="text-amber-300">0</span>);
});

<span class="text-fuchsia-300">it</span>(<span class="text-emerald-300">'asks before overwriting a tag'</span>, <span class="text-fuchsia-300">function</span> () {
    $this-&gt;<span class="text-sky-300">artisan</span>(<span class="text-emerald-300">'release --patch'</span>)
        -&gt;<span class="text-sky-300">expectsConfirmation</span>(<span class="text-emerald-300">'Tag exists. Replace it?'</span>, <span class="text-emerald-300">'no'</span>)
        -&gt;<span class="text-sky-300">assertExitCode</span>(<span class="text-amber-300">1</span>);
});</pre>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="relative overflow-hidden">
            <div class="pointer-events-none absolute -bottom-40 left-1/2 h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-fuchsia-600/20 blur-[130px]"></div>
            <div class="relative mx-auto max-w-3xl px-6 py-28 text-center">
                <h2 class="text-4xl font-extrabold tracking-[-0.02em] text-white text-balance sm:text-5xl">
                    Go on. <span class="gradient-text">Build something small.</span>
                </h2>
                <p class="mx-auto mt-5 max-w-lg leading-relaxed text-violet-200/70 text-pretty">
                    Free, open source, MIT licensed. Requires PHP 8.2 or higher.
                </p>
                <a href="#install" class="mt-9 inline-flex h-12 items-center justify-center rounded-full bg-linear-to-r from-violet-400 via-fuchsia-400 to-amber-300 px-8 text-sm font-bold text-[#120C1F] shadow-lg shadow-fuchsia-500/25 transition hover:brightness-110">
                    Create your first command
                </a>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-white/[0.06]">
            <div class="mx-auto flex max-w-6xl flex-col gap-5 px-6 py-10 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-violet-200/45">© {{ date('Y') }} Laravel Zero. Made with care by the community.</p>
                <div class="flex gap-6 text-sm text-violet-200/45">
                    <a href="#" class="transition hover:text-white">Docs</a>
                    <a href="#" class="transition hover:text-white">GitHub</a>
                    <a href="#" class="transition hover:text-white">Discord</a>
                    <a href="{{ route('designs.index') }}" class="transition hover:text-white">All designs</a>
                </div>
            </div>
        </footer>
    </body>
</html>
