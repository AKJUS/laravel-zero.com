<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>Laravel Zero — Console applications, without the ceremony</title>
        <meta name="description" content="Laravel Zero is a micro-framework for building console applications on top of Laravel's components.">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|jetbrains-mono:400,500,700" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-display { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            .font-code { font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace; }

            @keyframes zero-caret { 0%, 49% { opacity: 1 } 50%, 100% { opacity: 0 } }
            .caret { animation: zero-caret 1.1s steps(1) infinite; }

            @keyframes zero-rise { from { opacity: 0; transform: translateY(12px) } to { opacity: 1; transform: none } }
            .rise { animation: zero-rise .7s cubic-bezier(.16,1,.3,1) both; }

            .grid-fade {
                background-image:
                    linear-gradient(to right, rgba(255,255,255,.045) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(255,255,255,.045) 1px, transparent 1px);
                background-size: 72px 72px;
                mask-image: radial-gradient(ellipse 80% 55% at 50% 0%, #000 30%, transparent 75%);
            }
        </style>
    </head>
    <body class="font-display bg-[#08090A] text-zinc-300 antialiased selection:bg-emerald-300 selection:text-black">

        {{-- Nav --}}
        <header class="sticky top-0 z-50 border-b border-white/5 bg-[#08090A]/80 backdrop-blur-xl">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-6 px-6">
                <a href="#" class="flex items-center gap-2.5">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-[#08090A]">
                        <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 7l4 4-4 4M12 16h7"/>
                        </svg>
                    </span>
                    <span class="text-[15px] font-semibold tracking-tight text-white">Laravel Zero</span>
                </a>

                <nav class="hidden items-center gap-7 text-sm text-zinc-400 md:flex">
                    <a href="#features" class="transition hover:text-white">Features</a>
                    <a href="#build" class="transition hover:text-white">Build</a>
                    <a href="#addons" class="transition hover:text-white">Add-ons</a>
                    <a href="#" class="transition hover:text-white">Documentation</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="https://github.com/laravel-zero/laravel-zero" class="hidden items-center gap-2 rounded-lg border border-white/10 px-3 py-1.5 text-sm text-zinc-300 transition hover:border-white/25 hover:text-white sm:inline-flex">
                        <svg viewBox="0 0 16 16" class="h-4 w-4" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8a8 8 0 005.47 7.59c.4.07.55-.17.55-.38l-.01-1.49C3.79 14.16 3.32 12.9 3.32 12.9c-.36-.92-.89-1.17-.89-1.17-.72-.5.06-.49.06-.49.8.06 1.22.82 1.22.82.71 1.21 1.87.86 2.33.66.07-.52.28-.87.5-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.6 7.6 0 014 0c1.53-1.03 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.28.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48l-.01 2.2c0 .21.15.46.55.38A8 8 0 0016 8c0-4.42-3.58-8-8-8z"/></svg>
                        GitHub
                    </a>
                    <a href="#install" class="rounded-lg bg-white px-3.5 py-1.5 text-sm font-medium text-[#08090A] transition hover:bg-zinc-200">Get started</a>
                </div>
            </div>
        </header>

        {{-- Hero --}}
        <section class="relative overflow-hidden">
            <div class="pointer-events-none absolute inset-0 grid-fade"></div>
            <div class="pointer-events-none absolute -top-40 left-1/2 h-[420px] w-[820px] -translate-x-1/2 rounded-full bg-emerald-500/10 blur-[120px]"></div>

            <div class="relative mx-auto max-w-6xl px-6 pt-20 pb-16 sm:pt-28 sm:pb-24">
                <div class="mx-auto max-w-3xl text-center">
                    <a href="#" class="rise inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 py-1 pr-3 pl-1 text-xs text-zinc-400 transition hover:border-white/20 hover:text-zinc-200">
                        <span class="rounded-full bg-emerald-400/15 px-2 py-0.5 font-medium text-emerald-300">v12</span>
                        Now built on Laravel 12 components
                        <svg viewBox="0 0 12 12" class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4.5 2.5L8 6l-3.5 3.5"/></svg>
                    </a>

                    <h1 class="rise mt-8 text-4xl leading-[1.08] font-semibold tracking-[-0.03em] text-white text-balance sm:text-6xl sm:leading-[1.05] lg:text-7xl" style="animation-delay:.05s">
                        Console applications,<br class="hidden sm:inline">
                        <span class="text-zinc-500">without the ceremony.</span>
                    </h1>

                    <p class="rise mx-auto mt-6 max-w-xl text-lg leading-relaxed text-zinc-400 text-pretty" style="animation-delay:.12s">
                        A micro-framework for crafting beautiful command-line applications — powered by the Laravel
                        components you already know, with nothing you don't need.
                    </p>

                    <div class="rise mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row" style="animation-delay:.18s">
                        <a href="#" class="inline-flex h-11 items-center justify-center rounded-xl bg-white px-6 text-sm font-medium text-[#08090A] transition hover:bg-zinc-200">
                            Read the documentation
                        </a>
                        <a href="#build" class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-white/10 px-6 text-sm font-medium text-zinc-200 transition hover:border-white/25 hover:bg-white/5">
                            Ship a single binary
                            <svg viewBox="0 0 12 12" class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4.5 2.5L8 6l-3.5 3.5"/></svg>
                        </a>
                    </div>

                    <div id="install" class="rise mx-auto mt-10 flex max-w-xl items-center gap-3 rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-left" style="animation-delay:.24s">
                        <span class="font-code text-sm text-emerald-400 select-none">$</span>
                        <code class="font-code min-w-0 flex-1 truncate text-sm text-zinc-200">composer create-project laravel-zero/laravel-zero my-cli</code>
                        <button type="button" class="shrink-0 rounded-md p-1.5 text-zinc-500 transition hover:bg-white/5 hover:text-white" aria-label="Copy install command">
                            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="9" y="9" width="11" height="11" rx="2"/><path d="M5 15V5a2 2 0 012-2h8"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Terminal --}}
                <div class="rise mx-auto mt-16 max-w-4xl" style="animation-delay:.3s">
                    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0D0F11] shadow-2xl shadow-black/60">
                        <div class="flex items-center gap-2 border-b border-white/5 px-4 py-3">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#FF5F57]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#FEBC2E]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#28C840]"></span>
                            <span class="font-code ml-3 text-xs text-zinc-600">~/my-cli</span>
                        </div>
                        <div class="font-code overflow-x-auto p-5 text-[13px] leading-relaxed">
                            <p class="whitespace-nowrap"><span class="text-emerald-400">$</span> <span class="text-zinc-200">php my-cli deploy production</span></p>
                            <p class="mt-4 whitespace-nowrap text-zinc-500">Resolving strategy <span class="text-zinc-600">.................................</span> <span class="text-emerald-400">DONE</span></p>
                            <p class="whitespace-nowrap text-zinc-500">Building assets <span class="text-zinc-600">.....................................</span> <span class="text-emerald-400">DONE</span></p>
                            <p class="whitespace-nowrap text-zinc-500">Running migrations <span class="text-zinc-600">..................................</span> <span class="text-emerald-400">DONE</span></p>
                            <p class="whitespace-nowrap text-zinc-500">Warming caches <span class="text-zinc-600">......................................</span> <span class="text-emerald-400">DONE</span></p>
                            <p class="mt-4 whitespace-nowrap"><span class="rounded bg-emerald-400/15 px-2 py-0.5 text-emerald-300">SUCCESS</span> <span class="text-zinc-300">Deployed to production in 2.41s.</span></p>
                            <p class="mt-4 whitespace-nowrap"><span class="text-emerald-400">$</span> <span class="caret text-zinc-200">▌</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Logos / trust --}}
        <section class="border-y border-white/5 bg-white/[0.015]">
            <div class="mx-auto max-w-6xl px-6 py-10">
                <p class="text-center text-xs tracking-[0.18em] text-zinc-600 uppercase">Trusted by teams shipping developer tools</p>
                <div class="mt-6 grid grid-cols-2 gap-6 text-center text-sm font-medium text-zinc-600 sm:grid-cols-3 lg:grid-cols-6">
                    <span>Acme Labs</span>
                    <span>Northwind</span>
                    <span>Foundry</span>
                    <span>Helix</span>
                    <span>Basecamp Nine</span>
                    <span>Orbital</span>
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="mx-auto max-w-6xl px-6 py-24">
            <div class="max-w-2xl">
                <p class="font-code text-xs tracking-[0.18em] text-emerald-400 uppercase">Batteries, not baggage</p>
                <h2 class="mt-4 text-4xl font-semibold tracking-[-0.02em] text-white text-balance sm:text-5xl">
                    Everything a CLI needs. Nothing a website does.
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-zinc-400 text-pretty">
                    Laravel Zero strips the HTTP kernel, routing, sessions and views out of the equation, and keeps the
                    parts that make Laravel a joy — the container, the console kernel, and the ecosystem.
                </p>
            </div>

            <div class="mt-14 grid gap-px overflow-hidden rounded-2xl border border-white/10 bg-white/10 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $features = [
                        ['Single-file binaries', 'Compile your whole application into one standalone PHAR with a single command. Ship it anywhere PHP runs.', 'M12 3v12m0 0l-4-4m4 4l4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2'],
                        ['Expressive commands', 'Signatures, arguments, options and prompts — the exact Artisan API, with zero extra concepts to learn.', 'M5 7l4 4-4 4M12 16h7'],
                        ['Task scheduling', 'A full cron-style scheduler built in. Define schedules right next to the command they belong to.', 'M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Beautiful output', 'Termwind brings a Tailwind-like syntax to the terminal. Tables, spinners, tasks and progress bars included.', 'M4 6h16M4 12h10M4 18h13'],
                        ['First-class testing', 'Pest is wired up from the first commit. Assert exit codes, expected output and prompted answers.', 'M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Self-updating apps', 'Ship updates directly to your users. The self-update add-on pulls new releases straight from GitHub.', 'M4 4v6h6M20 20v-6h-6M20 9A8 8 0 006 5.3M4 15a8 8 0 0014 3.7'],
                    ];
                @endphp

                @foreach ($features as [$title, $body, $path])
                    <div class="group bg-[#08090A] p-8 transition hover:bg-[#0D0F11]">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-400 transition group-hover:border-emerald-400/30">
                            <svg viewBox="0 0 24 24" class="h-4.5 w-4.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $path }}"/></svg>
                        </span>
                        <h3 class="mt-5 text-base font-semibold text-white">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-zinc-400">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Code + build --}}
        <section id="build" class="border-t border-white/5 bg-white/[0.015]">
            <div class="mx-auto grid max-w-6xl items-center gap-14 px-6 py-24 lg:grid-cols-2">
                <div>
                    <p class="font-code text-xs tracking-[0.18em] text-emerald-400 uppercase">From class to binary</p>
                    <h2 class="mt-4 text-4xl font-semibold tracking-[-0.02em] text-white text-balance">
                        Write a command. Build a binary. Done.
                    </h2>
                    <p class="mt-5 leading-relaxed text-zinc-400 text-pretty">
                        A Laravel Zero command is a plain PHP class. When you're ready to distribute it, one command
                        compiles the application — dependencies and all — into a single executable file.
                    </p>

                    <dl class="mt-9 space-y-6 border-l border-white/10 pl-6">
                        <div>
                            <dt class="font-code text-sm text-white">php my-cli make:command Deploy</dt>
                            <dd class="mt-1 text-sm text-zinc-500">Scaffold a command into <code class="font-code">app/Commands</code>.</dd>
                        </div>
                        <div>
                            <dt class="font-code text-sm text-white">php my-cli app:rename</dt>
                            <dd class="mt-1 text-sm text-zinc-500">Give the binary the name your users will type.</dd>
                        </div>
                        <div>
                            <dt class="font-code text-sm text-white">php my-cli app:build</dt>
                            <dd class="mt-1 text-sm text-zinc-500">Produce a standalone PHAR in <code class="font-code">builds/</code>.</dd>
                        </div>
                    </dl>
                </div>

                <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0D0F11] shadow-2xl shadow-black/50">
                    <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                        <span class="font-code rounded-md bg-white/5 px-2 py-1 text-xs text-zinc-300">DeployCommand.php</span>
                    </div>
<pre class="font-code overflow-x-auto p-5 text-[13px] leading-relaxed text-zinc-300"><span class="text-zinc-600">&lt;?php</span>

<span class="text-fuchsia-400">namespace</span> App\Commands;

<span class="text-fuchsia-400">use</span> LaravelZero\Framework\Commands\Command;

<span class="text-fuchsia-400">final class</span> <span class="text-amber-300">DeployCommand</span> <span class="text-fuchsia-400">extends</span> <span class="text-amber-300">Command</span>
{
    <span class="text-fuchsia-400">protected</span> $signature = <span class="text-emerald-400">'deploy {env=staging}'</span>;

    <span class="text-fuchsia-400">protected</span> $description = <span class="text-emerald-400">'Deploy the application'</span>;

    <span class="text-fuchsia-400">public function</span> <span class="text-sky-300">handle</span>(Releaser $releaser): <span class="text-fuchsia-400">void</span>
    {
        $env = $this-&gt;<span class="text-sky-300">argument</span>(<span class="text-emerald-400">'env'</span>);

        $this-&gt;<span class="text-sky-300">task</span>(<span class="text-emerald-400">'Building assets'</span>, $releaser-&gt;build(...));
        $this-&gt;<span class="text-sky-300">task</span>(<span class="text-emerald-400">'Running migrations'</span>, $releaser-&gt;migrate(...));

        $this-&gt;<span class="text-sky-300">info</span>(<span class="text-emerald-400">"Deployed to {$env}."</span>);
    }
}</pre>
                </div>
            </div>
        </section>

        {{-- Add-ons --}}
        <section id="addons" class="mx-auto max-w-6xl px-6 py-24">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-xl">
                    <p class="font-code text-xs tracking-[0.18em] text-emerald-400 uppercase">Opt in, never out</p>
                    <h2 class="mt-4 text-4xl font-semibold tracking-[-0.02em] text-white text-balance">Install only what you use.</h2>
                </div>
                <p class="font-code text-sm text-zinc-500">php my-cli app:install &lt;addon&gt;</p>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $addons = [
                        ['database', 'Eloquent ORM, migrations and seeders.'],
                        ['log', 'Monolog channels wired to your app.'],
                        ['filesystem', 'Local and cloud disks via Flysystem.'],
                        ['dotenv', 'Environment files for local config.'],
                        ['menu', 'Interactive, arrow-key driven menus.'],
                        ['http', 'The Laravel HTTP client, ready to go.'],
                        ['queue', 'Background jobs with your favourite driver.'],
                        ['self-update', 'Let users upgrade in place.'],
                    ];
                @endphp

                @foreach ($addons as [$name, $body])
                    <div class="rounded-xl border border-white/10 bg-white/[0.02] p-5 transition hover:border-emerald-400/25 hover:bg-white/[0.04]">
                        <p class="font-code text-sm text-white">{{ $name }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-zinc-500">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- CTA --}}
        <section class="relative overflow-hidden border-t border-white/5">
            <div class="pointer-events-none absolute -bottom-56 left-1/2 h-[480px] w-[880px] -translate-x-1/2 rounded-full bg-emerald-500/10 blur-[130px]"></div>
            <div class="relative mx-auto max-w-3xl px-6 py-28 text-center">
                <h2 class="text-4xl font-semibold tracking-[-0.02em] text-white text-balance sm:text-5xl">
                    Your next CLI is one command away.
                </h2>
                <p class="mx-auto mt-5 max-w-lg leading-relaxed text-zinc-400 text-pretty">
                    Free, open source and MIT licensed. Requires PHP 8.2 or higher.
                </p>
                <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="#install" class="inline-flex h-11 items-center justify-center rounded-xl bg-white px-6 text-sm font-medium text-[#08090A] transition hover:bg-zinc-200">Start building</a>
                    <a href="https://github.com/laravel-zero/laravel-zero" class="inline-flex h-11 items-center justify-center rounded-xl border border-white/10 px-6 text-sm font-medium text-zinc-200 transition hover:border-white/25 hover:bg-white/5">Star on GitHub</a>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-white/5">
            <div class="mx-auto flex max-w-6xl flex-col gap-6 px-6 py-10 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-white/10 text-white">
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 7l4 4-4 4M12 16h7"/></svg>
                    </span>
                    <span class="text-sm text-zinc-500">Laravel Zero — a micro-framework by the community.</span>
                </div>
                <div class="flex gap-6 text-sm text-zinc-500">
                    <a href="#" class="transition hover:text-white">Docs</a>
                    <a href="#" class="transition hover:text-white">GitHub</a>
                    <a href="#" class="transition hover:text-white">Discord</a>
                    <a href="{{ route('designs.index') }}" class="transition hover:text-white">All designs</a>
                </div>
            </div>
        </footer>
    </body>
</html>
