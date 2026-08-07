<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>Laravel Zero — The console framework with taste</title>
        <meta name="description" content="Laravel Zero is a micro-framework for building console applications on top of Laravel's components.">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|instrument-serif:400,400i|jetbrains-mono:400,500" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-sans-app { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            .font-serif-app { font-family: 'Instrument Serif', ui-serif, Georgia, serif; }
            .font-code { font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace; }
            .paper { background-image: radial-gradient(#1b1b1810 1px, transparent 1px); background-size: 22px 22px; }
        </style>
    </head>
    <body class="font-sans-app bg-[#FDFDFC] text-[#1b1b18] antialiased selection:bg-[#f53003] selection:text-white">

        {{-- Nav --}}
        <header class="sticky top-0 z-50 border-b border-[#1914001a] bg-[#FDFDFC]/85 backdrop-blur">
            <div class="mx-auto flex h-[68px] max-w-6xl items-center justify-between gap-6 px-6">
                <a href="#" class="flex items-baseline gap-2">
                    <span class="font-serif-app text-2xl leading-none text-[#f53003]">Zero</span>
                    <span class="text-xs tracking-[0.16em] text-[#706f6c] uppercase">Laravel</span>
                </a>

                <nav class="hidden items-center gap-8 text-sm text-[#706f6c] md:flex">
                    <a href="#why" class="transition hover:text-[#1b1b18]">Why Zero</a>
                    <a href="#anatomy" class="transition hover:text-[#1b1b18]">Anatomy</a>
                    <a href="#steps" class="transition hover:text-[#1b1b18]">Ship it</a>
                    <a href="#" class="transition hover:text-[#1b1b18]">Docs</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="#" class="hidden text-sm text-[#706f6c] transition hover:text-[#1b1b18] sm:block">GitHub</a>
                    <a href="#install" class="rounded-sm border border-[#1b1b18] bg-[#1b1b18] px-5 py-1.5 text-sm text-white transition hover:bg-black">
                        Get started
                    </a>
                </div>
            </div>
        </header>

        {{-- Hero --}}
        <section class="relative overflow-hidden border-b border-[#1914001a]">
            <div class="paper pointer-events-none absolute inset-0 opacity-70"></div>
            <div class="relative mx-auto grid max-w-6xl gap-12 px-6 py-20 lg:grid-cols-[1.05fr_1fr] lg:items-center lg:py-28">
                <div class="min-w-0">
                    <p class="flex items-center gap-3 text-xs tracking-[0.18em] text-[#706f6c] uppercase">
                        <span class="h-px w-8 bg-[#f53003]"></span>
                        A micro-framework for the terminal
                    </p>

                    <h1 class="mt-7 text-4xl leading-[1.06] tracking-[-0.02em] text-balance sm:text-6xl sm:leading-[1.02] lg:text-7xl">
                        <span class="font-serif-app">The console framework</span><br>
                        <span class="font-serif-app italic text-[#f53003]">with taste.</span>
                    </h1>

                    <p class="mt-7 max-w-lg text-lg leading-relaxed text-[#4a4a46] text-pretty">
                        Laravel Zero takes the parts of Laravel that make development delightful — the container, the
                        console kernel, the ecosystem — and leaves the web behind. What's left is a framework that fits
                        entirely in your head.
                    </p>

                    <div id="install" class="mt-9 flex max-w-lg items-center gap-3 overflow-x-auto rounded-md border border-[#1914001a] bg-white px-4 py-3 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
                        <span class="font-code text-[13px] text-[#f53003] select-none">$</span>
                        <code class="font-code text-[13px] whitespace-nowrap">composer create-project laravel-zero/laravel-zero my-cli</code>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-[#706f6c]">
                        <span class="inline-flex items-center gap-2">
                            <svg viewBox="0 0 20 20" class="h-4 w-4 text-[#f53003]" fill="currentColor"><path d="M8.3 13.6L5 10.3l1.2-1.2 2.1 2.1 5.5-5.5L15 6.9z"/></svg>
                            MIT licensed
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <svg viewBox="0 0 20 20" class="h-4 w-4 text-[#f53003]" fill="currentColor"><path d="M8.3 13.6L5 10.3l1.2-1.2 2.1 2.1 5.5-5.5L15 6.9z"/></svg>
                            PHP 8.2+
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <svg viewBox="0 0 20 20" class="h-4 w-4 text-[#f53003]" fill="currentColor"><path d="M8.3 13.6L5 10.3l1.2-1.2 2.1 2.1 5.5-5.5L15 6.9z"/></svg>
                            Laravel 12 components
                        </span>
                    </div>
                </div>

                {{-- Console card --}}
                <div class="relative min-w-0">
                    <div class="absolute -inset-3 -rotate-1 rounded-xl border border-[#1914001a] bg-[#f8f8f6]"></div>
                    <div class="relative overflow-hidden rounded-lg border border-[#19140026] bg-[#1b1b18] shadow-[0_24px_48px_-24px_rgba(27,27,24,0.45)]">
                        <div class="flex items-center gap-2 border-b border-white/10 px-4 py-3">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#f53003]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#F8B803]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#8bbf6a]"></span>
                        </div>
                        <div class="font-code overflow-x-auto p-5 text-[13px] leading-relaxed text-[#e7e7e3]">
                            <p class="whitespace-nowrap"><span class="text-[#F8B803]">➜</span> php my-cli inspire --author</p>
                            <div class="mt-4 border-l-2 border-[#F8B803] pl-4">
                                <p class="whitespace-nowrap text-white">Simplicity is the ultimate</p>
                                <p class="whitespace-nowrap text-white">sophistication.</p>
                                <p class="mt-2 whitespace-nowrap text-[#F8B803]">— Leonardo da Vinci</p>
                            </div>
                            <p class="mt-4 whitespace-nowrap"><span class="text-[#F8B803]">➜</span> <span class="text-[#706f6c]">_</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Why --}}
        <section id="why" class="mx-auto max-w-6xl px-6 py-24">
            <div class="max-w-2xl">
                <h2 class="font-serif-app text-4xl leading-tight tracking-[-0.01em] text-balance sm:text-5xl">
                    Laravel's comfort, at a fraction of the weight.
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-[#4a4a46] text-pretty">
                    Every feature here exists because a command-line application needs it. Nothing was carried over out
                    of habit.
                </p>
            </div>

            <div class="mt-14 grid gap-px border border-[#1914001a] bg-[#1914001a] sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $features = [
                        ['01', 'Commands you already know', 'Signatures, arguments, options, prompts and output helpers — identical to Artisan. If you can write a Laravel command, you are done learning.'],
                        ['02', 'A single distributable file', 'One build command compiles your application, its vendor tree and its config into a standalone PHAR your users can simply run.'],
                        ['03', 'Scheduling included', 'Register cron expressions directly on the command. Run the scheduler from a single crontab entry and forget about it.'],
                        ['04', 'Output worth looking at', 'Termwind renders your terminal UI with familiar utility classes. Tables, tasks, spinners and progress bars ship out of the box.'],
                        ['05', 'Testing from minute one', 'Pest is installed and configured. Assert on exit codes, expected questions and every line of rendered output.'],
                        ['06', 'Add-ons, not assumptions', 'Databases, filesystems, queues and logging are one install command away — and completely absent until you ask.'],
                    ];
                @endphp

                @foreach ($features as [$num, $title, $body])
                    <article class="group bg-[#FDFDFC] p-8 transition hover:bg-white">
                        <span class="font-code text-xs text-[#f53003]">{{ $num }}</span>
                        <h3 class="mt-4 text-lg font-medium tracking-[-0.01em]">{{ $title }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-[#706f6c]">{{ $body }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- Anatomy --}}
        <section id="anatomy" class="border-y border-[#1914001a] bg-white">
            <div class="mx-auto grid max-w-6xl gap-14 px-6 py-24 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div>
                    <p class="text-xs tracking-[0.18em] text-[#706f6c] uppercase">The anatomy of a command</p>
                    <h2 class="font-serif-app mt-5 text-4xl leading-tight tracking-[-0.01em] text-balance">
                        A class, a signature, a <span class="italic text-[#f53003]">handle</span> method.
                    </h2>
                    <p class="mt-6 leading-relaxed text-[#4a4a46] text-pretty">
                        Dependencies are resolved out of the container, exactly as they are in a Laravel controller.
                        There is no new mental model to adopt — only a smaller one.
                    </p>

                    <ul class="mt-8 space-y-4 text-sm">
                        <li class="flex gap-3 border-b border-[#1914001a] pb-4">
                            <span class="font-code shrink-0 text-[#f53003]">01</span>
                            <span class="text-[#4a4a46]">Scaffold with <code class="font-code text-[#1b1b18]">make:command</code>.</span>
                        </li>
                        <li class="flex gap-3 border-b border-[#1914001a] pb-4">
                            <span class="font-code shrink-0 text-[#f53003]">02</span>
                            <span class="text-[#4a4a46]">Declare the signature your users will type.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-code shrink-0 text-[#f53003]">03</span>
                            <span class="text-[#4a4a46]">Type-hint whatever you need and let the container do the rest.</span>
                        </li>
                    </ul>
                </div>

                <div class="overflow-hidden rounded-lg border border-[#19140026] bg-[#1b1b18] shadow-[0_24px_48px_-28px_rgba(27,27,24,0.4)]">
                    <div class="border-b border-white/10 px-5 py-3">
                        <span class="font-code text-xs text-[#a1a09a]">app/Commands/ReportCommand.php</span>
                    </div>
<pre class="font-code overflow-x-auto p-6 text-[13px] leading-relaxed text-[#e7e7e3]"><span class="text-[#706f6c]">&lt;?php</span>

<span class="text-[#FF9F87]">namespace</span> App\Commands;

<span class="text-[#FF9F87]">use</span> LaravelZero\Framework\Commands\Command;

<span class="text-[#FF9F87]">final class</span> <span class="text-[#F8B803]">ReportCommand</span> <span class="text-[#FF9F87]">extends</span> <span class="text-[#F8B803]">Command</span>
{
    <span class="text-[#FF9F87]">protected</span> $signature = <span class="text-[#8bbf6a]">'report {--format=table}'</span>;

    <span class="text-[#FF9F87]">public function</span> <span class="text-[#8fc7e8]">handle</span>(Metrics $metrics): <span class="text-[#FF9F87]">int</span>
    {
        $this-&gt;<span class="text-[#8fc7e8]">table</span>(
            [<span class="text-[#8bbf6a]">'Metric'</span>, <span class="text-[#8bbf6a]">'Today'</span>, <span class="text-[#8bbf6a]">'Change'</span>],
            $metrics-&gt;<span class="text-[#8fc7e8]">summary</span>(),
        );

        <span class="text-[#FF9F87]">return</span> self::SUCCESS;
    }

    <span class="text-[#FF9F87]">public function</span> <span class="text-[#8fc7e8]">schedule</span>(Schedule $schedule): <span class="text-[#FF9F87]">void</span>
    {
        $schedule-&gt;<span class="text-[#8fc7e8]">command</span>(static::class)-&gt;<span class="text-[#8fc7e8]">dailyAt</span>(<span class="text-[#8bbf6a]">'09:00'</span>);
    }
}</pre>
                </div>
            </div>
        </section>

        {{-- Steps --}}
        <section id="steps" class="mx-auto max-w-6xl px-6 py-24">
            <h2 class="font-serif-app max-w-xl text-4xl leading-tight tracking-[-0.01em] text-balance sm:text-5xl">
                From an empty folder to a shipped binary.
            </h2>

            <div class="mt-14 grid gap-10 md:grid-cols-3">
                @php
                    $steps = [
                        ['Create', 'composer create-project laravel-zero/laravel-zero my-cli', 'A working application with a sensible structure, a first command and a test suite.'],
                        ['Name it', 'php my-cli app:rename', 'Choose the binary name your users will type. Namespaces and the entry point follow along.'],
                        ['Build', 'php my-cli app:build', 'A compiled, single-file executable lands in builds/, ready to publish anywhere.'],
                    ];
                @endphp

                @foreach ($steps as $i => [$title, $command, $body])
                    <div class="relative min-w-0">
                        <span class="font-serif-app text-6xl leading-none text-[#e6e5e0]">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-4 text-lg font-medium">{{ $title }}</h3>
                        <code class="font-code mt-3 block overflow-x-auto rounded-md border border-[#1914001a] bg-white px-3 py-2 text-xs whitespace-nowrap text-[#4a4a46]">{{ $command }}</code>
                        <p class="mt-4 text-sm leading-relaxed text-[#706f6c]">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Quote --}}
        <section class="border-y border-[#1914001a] bg-white">
            <figure class="mx-auto max-w-3xl px-6 py-24 text-center">
                <blockquote class="font-serif-app text-3xl leading-snug tracking-[-0.01em] text-balance sm:text-4xl">
                    “We replaced a pile of shell scripts with one Laravel Zero binary. Onboarding a new engineer went
                    from an afternoon to <span class="italic text-[#f53003]">a single download</span>.”
                </blockquote>
                <figcaption class="mt-8 text-sm text-[#706f6c]">
                    Platform Engineering — Northwind
                </figcaption>
            </figure>
        </section>

        {{-- CTA --}}
        <section class="mx-auto max-w-6xl px-6 py-24">
            <div class="flex flex-col items-start justify-between gap-8 rounded-lg border border-[#1914001a] bg-[#1b1b18] p-10 text-white lg:flex-row lg:items-center lg:p-14">
                <div class="max-w-xl">
                    <h2 class="font-serif-app text-3xl leading-tight text-balance sm:text-4xl">Start your CLI this afternoon.</h2>
                    <p class="mt-4 leading-relaxed text-[#a1a09a] text-pretty">
                        Open source, MIT licensed and maintained in the open. Contributions and stars are always welcome.
                    </p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="#" class="inline-flex h-11 items-center justify-center rounded-sm bg-white px-6 text-sm font-medium text-[#1b1b18] transition hover:bg-[#eeeeec]">Read the docs</a>
                    <a href="#" class="inline-flex h-11 items-center justify-center rounded-sm border border-white/25 px-6 text-sm font-medium transition hover:border-white">GitHub</a>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-[#1914001a]">
            <div class="mx-auto grid max-w-6xl gap-10 px-6 py-14 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <p class="font-serif-app text-2xl text-[#f53003]">Zero</p>
                    <p class="mt-3 text-sm leading-relaxed text-[#706f6c]">A micro-framework for console applications.</p>
                </div>
                @php
                    $columns = [
                        'Learn' => ['Documentation', 'Upgrade guide', 'Commands', 'Testing'],
                        'Ecosystem' => ['Add-ons', 'Termwind', 'Pest', 'Collision'],
                        'Community' => ['GitHub', 'Discord', 'Contributing', 'Sponsors'],
                    ];
                @endphp
                @foreach ($columns as $heading => $links)
                    <div>
                        <p class="text-xs tracking-[0.16em] text-[#1b1b18] uppercase">{{ $heading }}</p>
                        <ul class="mt-4 space-y-2.5 text-sm text-[#706f6c]">
                            @foreach ($links as $link)
                                <li><a href="#" class="transition hover:text-[#1b1b18]">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-[#1914001a]">
                <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6 text-xs text-[#706f6c]">
                    <span>© {{ date('Y') }} Laravel Zero. MIT licensed.</span>
                    <a href="{{ route('designs.index') }}" class="transition hover:text-[#1b1b18]">All designs</a>
                </div>
            </div>
        </footer>
    </body>
</html>
