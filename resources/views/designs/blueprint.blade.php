<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>Laravel Zero — A micro-framework for console applications</title>
        <meta name="description" content="Laravel Zero is a micro-framework for building console applications on top of Laravel's components.">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|jetbrains-mono:400,500,700" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-display { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; font-feature-settings: 'ss01', 'cv11'; }
            .font-code { font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace; }
            .label { font-family: 'JetBrains Mono', ui-monospace, monospace; font-size: 11px; letter-spacing: .14em; text-transform: uppercase; }
            .rule-grid {
                background-image: linear-gradient(to right, #E7E7E4 1px, transparent 1px);
                background-size: calc(100% / 6) 100%;
            }
        </style>
    </head>
    <body class="font-display bg-white text-[#0C0C0C] antialiased selection:bg-[#0032FF] selection:text-white">

        {{-- Nav --}}
        <header class="sticky top-0 z-50 border-b border-[#E7E7E4] bg-white/90 backdrop-blur">
            <div class="mx-auto flex h-14 max-w-[1180px] items-stretch justify-between px-6">
                <a href="#" class="flex items-center gap-3 border-r border-[#E7E7E4] pr-6">
                    <span class="flex h-6 w-6 items-center justify-center bg-[#0C0C0C] text-white">
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 7l4 4-4 4M12 16h7"/></svg>
                    </span>
                    <span class="text-sm font-semibold tracking-[-0.01em]">LARAVEL ZERO</span>
                </a>

                <nav class="hidden flex-1 items-stretch md:flex">
                    @foreach (['Overview' => '#overview', 'Commands' => '#commands', 'Build' => '#build', 'Add-ons' => '#addons'] as $label => $href)
                        <a href="{{ $href }}" class="label flex items-center border-r border-[#E7E7E4] px-6 text-[#6B6B67] transition hover:bg-[#FAFAF9] hover:text-[#0C0C0C]">{{ $label }}</a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-6">
                    <a href="#" class="label hidden text-[#6B6B67] transition hover:text-[#0C0C0C] sm:block">Docs</a>
                    <a href="#install" class="label flex items-center bg-[#0C0C0C] px-4 py-2 text-white transition hover:bg-[#0032FF]">Install</a>
                </div>
            </div>
        </header>

        {{-- Hero --}}
        <section class="relative border-b border-[#E7E7E4]">
            <div class="pointer-events-none absolute inset-0 mx-auto hidden max-w-[1180px] rule-grid opacity-60 lg:block"></div>

            <div class="relative mx-auto max-w-[1180px] px-6">
                <div class="grid gap-12 border-x border-[#E7E7E4] px-5 py-20 sm:px-8 lg:grid-cols-[1.15fr_1fr] lg:py-28">
                    <div>
                        <p class="label flex items-center gap-3 text-[#0032FF]">
                            <span class="h-1.5 w-1.5 bg-[#0032FF]"></span>
                            v12.0 — Laravel 12 · PHP 8.2+
                        </p>

                        <h1 class="mt-8 text-4xl leading-[1.02] font-semibold tracking-[-0.035em] text-balance sm:text-6xl sm:leading-[0.98] lg:text-7xl">
                            A micro-framework <br class="hidden sm:inline">for console <br class="hidden sm:inline">applications.
                        </h1>

                        <p class="mt-8 max-w-md text-[17px] leading-relaxed text-[#4A4A46] text-pretty">
                            Laravel Zero removes the HTTP layer, the routing, the sessions and the views. What remains is
                            a fast, focused foundation for the command-line tools your team actually runs.
                        </p>

                        <div class="mt-10 flex flex-wrap items-center gap-3">
                            <a href="#" class="label flex h-11 items-center bg-[#0C0C0C] px-6 text-white transition hover:bg-[#0032FF]">Documentation</a>
                            <a href="#overview" class="label flex h-11 items-center border border-[#0C0C0C] px-6 transition hover:bg-[#FAFAF9]">Read the overview</a>
                        </div>
                    </div>

                    <div class="min-w-0 lg:pl-8">
                        <div class="border border-[#E7E7E4]">
                            <div class="label flex items-center justify-between border-b border-[#E7E7E4] bg-[#FAFAF9] px-4 py-2.5 text-[#6B6B67]">
                                <span>Terminal</span>
                                <span>zsh</span>
                            </div>
                            <div class="font-code overflow-x-auto bg-[#0C0C0C] p-5 text-[12.5px] leading-relaxed text-[#D4D4D0]">
                                <p class="whitespace-nowrap"><span class="text-[#0032FF]">$</span> php my-cli migrate:audit</p>

                                <table class="mt-4 w-full text-left">
                                    <thead>
                                        <tr class="border-b border-white/15 text-white">
                                            <th scope="col" class="pb-1.5 pr-6 font-normal">Migration</th>
                                            <th scope="col" class="pb-1.5 pr-6 font-normal">Batch</th>
                                            <th scope="col" class="pb-1.5 font-normal">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-[#7C7C78]">
                                        <tr><td class="pt-2 pr-6 whitespace-nowrap">create_users</td><td class="pt-2 pr-6">1</td><td class="pt-2 text-emerald-400">ran</td></tr>
                                        <tr><td class="pt-1 pr-6 whitespace-nowrap">add_indexes</td><td class="pt-1 pr-6">2</td><td class="pt-1 text-emerald-400">ran</td></tr>
                                        <tr><td class="pt-1 pr-6 whitespace-nowrap">drop_legacy</td><td class="pt-1 pr-6">-</td><td class="pt-1 text-amber-400">pending</td></tr>
                                    </tbody>
                                </table>

                                <p class="mt-4 whitespace-nowrap text-[#7C7C78]">3 migrations · 1 pending · 0.08s</p>
                            </div>
                        </div>

                        <div id="install" class="mt-4 border border-[#E7E7E4]">
                            <p class="label border-b border-[#E7E7E4] bg-[#FAFAF9] px-4 py-2.5 text-[#6B6B67]">Install</p>
                            <code class="font-code block overflow-x-auto px-4 py-3.5 text-[12.5px] whitespace-nowrap">composer create-project laravel-zero/laravel-zero my-cli</code>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Facts strip --}}
        <section class="border-b border-[#E7E7E4]">
            <div class="mx-auto max-w-[1180px] px-6">
                <dl class="grid gap-px border-x border-[#E7E7E4] bg-[#E7E7E4] sm:grid-cols-2 lg:grid-cols-4">
                    @php
                        $facts = [
                            ['Dependencies', 'Laravel components only'],
                            ['Distribution', 'One standalone PHAR'],
                            ['Testing', 'Pest, pre-configured'],
                            ['License', 'MIT, open source'],
                        ];
                    @endphp
                    @foreach ($facts as [$term, $value])
                        <div class="bg-white px-5 py-8 sm:px-8">
                            <dt class="label text-[#6B6B67]">{{ $term }}</dt>
                            <dd class="mt-3 text-lg tracking-[-0.01em]">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </section>

        {{-- Overview --}}
        <section id="overview" class="border-b border-[#E7E7E4]">
            <div class="mx-auto max-w-[1180px] px-6">
                <div class="border-x border-[#E7E7E4]">
                    <div class="border-b border-[#E7E7E4] px-5 py-10 sm:px-8">
                        <p class="label text-[#0032FF]">01 — Overview</p>
                        <h2 class="mt-5 max-w-2xl text-3xl leading-tight font-semibold tracking-[-0.025em] text-balance sm:text-4xl">
                            Six things you get on the first commit.
                        </h2>
                    </div>

                    <div class="grid gap-px bg-[#E7E7E4] sm:grid-cols-2 lg:grid-cols-3">
                        @php
                            $features = [
                                ['Console kernel', 'The full Artisan command layer — signatures, arguments, options, prompts and output helpers, unchanged.'],
                                ['Service container', 'Constructor and method injection everywhere, with the same binding and singleton APIs as Laravel.'],
                                ['Task scheduling', 'Declare a schedule on the command itself and drive the entire application from one crontab entry.'],
                                ['Compiler', 'app:build produces a single executable file containing your code, config and vendor tree.'],
                                ['Termwind rendering', 'Style terminal output with utility classes. Tables, tasks, spinners and progress bars included.'],
                                ['Pest test suite', 'A configured test suite from the start, with helpers for exit codes, prompts and output assertions.'],
                            ];
                        @endphp
                        @foreach ($features as $i => [$title, $body])
                            <article class="group bg-white px-5 py-9 sm:px-8 transition hover:bg-[#FAFAF9]">
                                <p class="label text-[#B4B4B0] transition group-hover:text-[#0032FF]">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                                <h3 class="mt-4 text-base font-semibold tracking-[-0.01em]">{{ $title }}</h3>
                                <p class="mt-3 text-sm leading-relaxed text-[#6B6B67]">{{ $body }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Commands --}}
        <section id="commands" class="border-b border-[#E7E7E4]">
            <div class="mx-auto max-w-[1180px] px-6">
                <div class="grid border-x border-[#E7E7E4] lg:grid-cols-2">
                    <div class="min-w-0 border-b border-[#E7E7E4] px-5 py-14 sm:px-8 lg:border-r lg:border-b-0">
                        <p class="label text-[#0032FF]">02 — Commands</p>
                        <h2 class="mt-5 text-3xl leading-tight font-semibold tracking-[-0.025em] text-balance sm:text-4xl">
                            A command is a class. That is the whole model.
                        </h2>
                        <p class="mt-6 max-w-md leading-relaxed text-[#4A4A46] text-pretty">
                            Nothing is registered by hand. Drop a class into <code class="font-code text-[#0C0C0C]">app/Commands</code>
                            and it becomes part of your application's interface immediately.
                        </p>

                        <table class="mt-10 w-full text-left text-sm">
                            <tbody class="divide-y divide-[#E7E7E4]">
                                @php
                                    $commands = [
                                        ['make:command', 'Scaffold a new command class'],
                                        ['app:rename', 'Rename the compiled binary'],
                                        ['app:build', 'Compile a standalone PHAR'],
                                        ['app:install', 'Add an optional component'],
                                    ];
                                @endphp
                                @foreach ($commands as [$name, $desc])
                                    <tr>
                                        <th scope="row" class="font-code py-3.5 pr-6 text-[12.5px] font-normal whitespace-nowrap">{{ $name }}</th>
                                        <td class="py-3.5 text-[#6B6B67]">{{ $desc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="min-w-0 bg-[#0C0C0C]">
                        <div class="label flex items-center justify-between border-b border-white/10 px-6 py-3 text-[#7C7C78]">
                            <span>app/Commands/AuditCommand.php</span>
                            <span>PHP</span>
                        </div>
<pre class="font-code overflow-x-auto px-6 py-7 text-[12.5px] leading-relaxed text-[#D4D4D0]"><span class="text-[#7C7C78]">&lt;?php</span>

<span class="text-[#7FB2FF]">declare</span>(strict_types=<span class="text-amber-300">1</span>);

<span class="text-[#7FB2FF]">namespace</span> App\Commands;

<span class="text-[#7FB2FF]">use</span> Illuminate\Console\Scheduling\Schedule;
<span class="text-[#7FB2FF]">use</span> LaravelZero\Framework\Commands\Command;

<span class="text-[#7FB2FF]">final class</span> <span class="text-white">AuditCommand</span> <span class="text-[#7FB2FF]">extends</span> <span class="text-white">Command</span>
{
    <span class="text-[#7FB2FF]">protected</span> $signature = <span class="text-emerald-400">'migrate:audit {--pending}'</span>;

    <span class="text-[#7FB2FF]">protected</span> $description = <span class="text-emerald-400">'Audit database migrations'</span>;

    <span class="text-[#7FB2FF]">public function</span> <span class="text-white">handle</span>(Auditor $auditor): <span class="text-[#7FB2FF]">int</span>
    {
        $rows = $auditor-&gt;inspect(
            pendingOnly: (bool) $this-&gt;option(<span class="text-emerald-400">'pending'</span>),
        );

        $this-&gt;table([<span class="text-emerald-400">'Migration'</span>, <span class="text-emerald-400">'Batch'</span>, <span class="text-emerald-400">'Status'</span>], $rows);

        <span class="text-[#7FB2FF]">return</span> self::SUCCESS;
    }

    <span class="text-[#7FB2FF]">public function</span> <span class="text-white">schedule</span>(Schedule $schedule): <span class="text-[#7FB2FF]">void</span>
    {
        $schedule-&gt;command(static::class)-&gt;hourly();
    }
}</pre>
                    </div>
                </div>
            </div>
        </section>

        {{-- Build --}}
        <section id="build" class="border-b border-[#E7E7E4]">
            <div class="mx-auto max-w-[1180px] px-6">
                <div class="border-x border-[#E7E7E4]">
                    <div class="border-b border-[#E7E7E4] px-5 py-10 sm:px-8">
                        <p class="label text-[#0032FF]">03 — Distribution</p>
                        <h2 class="mt-5 max-w-2xl text-3xl leading-tight font-semibold tracking-[-0.025em] text-balance sm:text-4xl">
                            One artifact. No runtime to explain.
                        </h2>
                    </div>

                    <div class="grid lg:grid-cols-3">
                        @php
                            $steps = [
                                ['Write', 'php my-cli make:command Audit', 'Add commands until the tool does what your team needs. Test them as you go.'],
                                ['Name', 'php my-cli app:rename audit', 'Pick the binary name. The entry point and namespaces are rewritten for you.'],
                                ['Build', 'php my-cli app:build', 'A single executable file appears in builds/. Publish it however you like.'],
                            ];
                        @endphp
                        @foreach ($steps as $i => [$title, $command, $body])
                            <div @class(['px-5 py-10 sm:px-8', 'border-t border-[#E7E7E4] lg:border-t-0 lg:border-l' => $i > 0])>
                                <p class="label text-[#0032FF]">Step {{ $i + 1 }}</p>
                                <h3 class="mt-4 text-xl font-semibold tracking-[-0.02em]">{{ $title }}</h3>
                                <code class="font-code mt-5 block overflow-x-auto border border-[#E7E7E4] bg-[#FAFAF9] px-3 py-2.5 text-[12px] whitespace-nowrap">{{ $command }}</code>
                                <p class="mt-4 text-sm leading-relaxed text-[#6B6B67]">{{ $body }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Add-ons --}}
        <section id="addons" class="border-b border-[#E7E7E4]">
            <div class="mx-auto max-w-[1180px] px-6">
                <div class="border-x border-[#E7E7E4]">
                    <div class="flex flex-col gap-4 border-b border-[#E7E7E4] px-5 py-10 sm:px-8 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="label text-[#0032FF]">04 — Add-ons</p>
                            <h2 class="mt-5 text-3xl leading-tight font-semibold tracking-[-0.025em] text-balance sm:text-4xl">
                                Absent until you ask for them.
                            </h2>
                        </div>
                        <code class="font-code text-sm text-[#6B6B67]">php my-cli app:install &lt;addon&gt;</code>
                    </div>

                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="label border-b border-[#E7E7E4] bg-[#FAFAF9] text-[#6B6B67]">
                                <th scope="col" class="px-5 py-3 sm:px-8 font-normal">Component</th>
                                <th scope="col" class="hidden px-6 py-3 font-normal sm:table-cell">Provides</th>
                                <th scope="col" class="px-5 py-3 sm:px-8 text-right font-normal">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E7E7E4]">
                            @php
                                $addons = [
                                    ['database', 'Eloquent ORM, migrations, seeders', 'Optional'],
                                    ['log', 'Monolog channels and handlers', 'Optional'],
                                    ['filesystem', 'Flysystem disks, local and cloud', 'Optional'],
                                    ['dotenv', 'Environment file loading', 'Optional'],
                                    ['menu', 'Interactive, arrow-key menus', 'Optional'],
                                    ['queue', 'Background job dispatching', 'Optional'],
                                    ['http', 'The Laravel HTTP client', 'Optional'],
                                    ['self-update', 'In-place upgrades for your users', 'Optional'],
                                ];
                            @endphp
                            @foreach ($addons as [$name, $provides, $status])
                                <tr class="transition hover:bg-[#FAFAF9]">
                                    <th scope="row" class="font-code px-5 py-4 sm:px-8 font-normal whitespace-nowrap">{{ $name }}</th>
                                    <td class="hidden px-6 py-4 text-[#6B6B67] sm:table-cell">{{ $provides }}</td>
                                    <td class="label px-5 py-4 sm:px-8 text-right text-[#6B6B67]">{{ $status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="border-b border-[#E7E7E4] bg-[#0C0C0C] text-white">
            <div class="mx-auto max-w-[1180px] px-6">
                <div class="grid gap-10 border-x border-white/10 px-5 py-20 sm:px-8 lg:grid-cols-2 lg:items-center">
                    <div class="min-w-0">
                        <p class="label text-[#7FB2FF]">Get started</p>
                        <h2 class="mt-5 text-4xl leading-tight font-semibold tracking-[-0.03em] text-balance">
                            Build the tool your team keeps meaning to write.
                        </h2>
                    </div>
                    <div class="min-w-0 lg:justify-self-end">
                        <code class="font-code block overflow-x-auto border border-white/15 px-5 py-4 text-[12.5px] whitespace-nowrap text-[#D4D4D0]">composer create-project laravel-zero/laravel-zero my-cli</code>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="#" class="label flex h-11 items-center bg-white px-6 text-[#0C0C0C] transition hover:bg-[#0032FF] hover:text-white">Documentation</a>
                            <a href="#" class="label flex h-11 items-center border border-white/25 px-6 transition hover:border-white">GitHub</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer>
            <div class="mx-auto max-w-[1180px] px-6">
                <div class="flex flex-col gap-4 border-x border-[#E7E7E4] px-5 py-8 sm:px-8 sm:flex-row sm:items-center sm:justify-between">
                    <p class="label text-[#6B6B67]">© {{ date('Y') }} Laravel Zero · MIT</p>
                    <div class="label flex gap-6 text-[#6B6B67]">
                        <a href="#" class="transition hover:text-[#0C0C0C]">Docs</a>
                        <a href="#" class="transition hover:text-[#0C0C0C]">GitHub</a>
                        <a href="#" class="transition hover:text-[#0C0C0C]">Discord</a>
                        <a href="{{ route('designs.index') }}" class="transition hover:text-[#0C0C0C]">All designs</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
