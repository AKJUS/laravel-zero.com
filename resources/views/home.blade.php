@php
    use App\Support\Seo;

    $installCommand = 'composer create-project laravel-zero/laravel-zero my-cli';

    // Linked data for the framework itself. Rendered only here: the docs
    // describe the software, the landing page *is* its listing.
    $schema = [
        [
            '@type' => 'SoftwareApplication',
            '@id' => Seo::url('#software'),
            'name' => 'Laravel Zero',
            'url' => Seo::url(),
            'description' => config('seo.description'),
            'applicationCategory' => 'DeveloperApplication',
            'applicationSubCategory' => 'Console application framework',
            'operatingSystem' => 'macOS, Linux, Windows',
            'programmingLanguage' => 'PHP',
            'license' => 'https://opensource.org/licenses/MIT',
            'downloadUrl' => config('seo.repository'),
            'softwareHelp' => Seo::url('docs/introduction'),
            'isAccessibleForFree' => true,
            'author' => [
                '@type' => 'Person',
                'name' => 'Nuno Maduro',
                'url' => 'https://github.com/nunomaduro',
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'USD',
            ],
        ],
    ];

    $features = [
        ['Single-file binaries', 'Compile your whole application into one standalone PHAR with a single command. Ship it anywhere PHP runs.', 'M12 3v12m0 0l-4-4m4 4l4-4M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2'],
        ['Expressive commands', 'Signatures, arguments, options and prompts — the exact Artisan API, with zero extra concepts to learn.', 'M5 7l4 4-4 4M12 16h7'],
        ['Task scheduling', 'A full cron-style scheduler built in. Define schedules right next to the command they belong to.', 'M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['Beautiful output', 'Termwind brings a Tailwind-like syntax to the terminal. Tables, spinners, tasks and progress bars included.', 'M4 6h16M4 12h10M4 18h13'],
        ['First-class testing', 'Pest is wired up from the first commit. Assert exit codes, expected output and prompted answers.', 'M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['Self-updating apps', 'Ship updates directly to your users. The self-update add-on pulls new releases straight from GitHub.', 'M4 4v6h6M20 20v-6h-6M20 9A8 8 0 006 5.3M4 15a8 8 0 0014 3.7'],
    ];

    $poweredBy = [
        ['Laravel Pint', 'pint'],
        ['Forge CLI', 'forge'],
        ['Cloud CLI', 'cloud'],
        ['Expose', 'expose'],
    ];

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

<x-layouts.app :schema="$schema">
    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 grid-fade"></div>
        <div class="pointer-events-none absolute -top-40 left-1/2 h-[420px] w-[820px] -translate-x-1/2 rounded-full bg-accent-glow/10 blur-[120px]"></div>

        <x-container class="relative pt-20 pb-16 sm:pt-28 sm:pb-24">
            <div class="mx-auto max-w-3xl text-center">
                <h1 class="rise text-4xl leading-[1.08] font-semibold tracking-[-0.03em] text-white text-balance sm:text-6xl sm:leading-[1.05] lg:text-7xl">
                    Console applications,<br class="hidden sm:inline">
                    <span class="text-zinc-500">without the ceremony.</span>
                </h1>

                <p class="rise mx-auto mt-6 max-w-xl text-lg leading-relaxed text-zinc-400 text-pretty" style="animation-delay:.06s">
                    A micro-framework for crafting beautiful command-line applications — powered by the Laravel
                    components you already know, with nothing you don't need.
                </p>

                <div class="rise mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row" style="animation-delay:.12s">
                    <x-button :href="route('docs')">Read the documentation</x-button>

                    <x-button variant="secondary" href="#build">
                        Ship a single binary
                        <x-icons.chevron />
                    </x-button>
                </div>

                <div id="install" class="rise mx-auto mt-10 flex max-w-xl items-center gap-3 rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-left" style="animation-delay:.18s">
                    <span class="font-code text-sm text-accent select-none" aria-hidden="true">$</span>
                    <code class="font-code min-w-0 flex-1 truncate text-sm text-zinc-200">{{ $installCommand }}</code>
                    <x-copy-button :value="$installCommand" label="Copy install command" />
                </div>
            </div>

            {{-- Terminal --}}
            <div class="rise mx-auto mt-16 max-w-4xl" style="animation-delay:.24s">
                <x-terminal path="~/my-cli">
                    <p class="whitespace-nowrap"><span class="text-accent">$</span> <span class="text-zinc-200">php my-cli deploy production</span></p>

                    {{-- The dot leaders are drawn rather than typed, so the status
                         column lines up whatever the length of the task name. --}}
                    <div class="mt-4 text-zinc-500">
                        @foreach (['Resolving strategy', 'Building assets', 'Running migrations', 'Warming caches'] as $task)
                            <p class="flex items-center gap-2 whitespace-nowrap">
                                <span class="shrink-0">{{ $task }}</span>
                                <span class="leader min-w-0 flex-1 self-stretch text-zinc-600" aria-hidden="true"></span>
                                <span class="shrink-0 text-accent">DONE</span>
                            </p>
                        @endforeach
                    </div>
                    <p class="mt-4 whitespace-nowrap"><span class="rounded bg-accent/15 px-2 py-0.5 text-accent-strong">SUCCESS</span> <span class="text-zinc-300">Deployed to production in 2.41s.</span></p>
                    <p class="mt-4 whitespace-nowrap"><span class="text-accent">$</span> <span class="caret text-zinc-200" aria-hidden="true">▌</span></p>
                </x-terminal>
            </div>
        </x-container>
    </section>

    {{-- Logos / trust --}}
    <section class="border-y border-white/5 bg-white/[0.015]">
        <x-container class="py-14 sm:py-16">
            <p class="text-center text-[13px] font-medium tracking-[0.2em] text-zinc-600 uppercase">Powers the tools developers reach for every day</p>

            {{-- An even 2x2 while the lockups are too wide for one line, then a
                 single centred row — tighter than the full measure, where the
                 four marks read as four lonely items. Left to wrap on its own
                 the row breaks 3-and-1, which looks like something is missing. --}}
            <div class="mx-auto mt-10 grid max-w-4xl grid-cols-2 items-center justify-items-center gap-x-8 gap-y-8 md:mt-11 md:flex md:flex-wrap md:justify-center md:gap-x-10 md:gap-y-9 lg:gap-x-20">
                @foreach ($poweredBy as [$name, $icon])
                    <div class="flex min-w-0 items-center gap-3 text-zinc-300 md:gap-3.5">
                        @if ($icon)
                            {{-- The size lives here: these marks carry no
                                 default of their own, so nothing can conflict. --}}
                            <x-dynamic-component :component="'icons.'.$icon" class="h-7 w-7 shrink-0 md:h-8 md:w-8" />
                        @endif
                        <span class="truncate text-lg font-medium tracking-tight md:text-xl">{{ $name }}</span>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- Features --}}
    <section id="features" class="scroll-mt-16">
        <x-container class="py-24">
            <x-section-heading
                class="max-w-2xl"
                size="lg"
                eyebrow="Batteries, not baggage"
                title="Everything a CLI needs. Nothing a website does."
            >
                Laravel Zero strips the HTTP kernel, routing, sessions and views out of the equation, and keeps the
                parts that make Laravel a joy — the container, the console kernel, and the ecosystem.
            </x-section-heading>

            <div class="mt-14 grid gap-px overflow-hidden rounded-2xl border border-white/10 bg-white/10 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as [$title, $body, $icon])
                    <x-feature-card :title="$title" :icon="$icon">{{ $body }}</x-feature-card>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- Code + build --}}
    <section id="build" class="scroll-mt-16 border-t border-white/5 bg-white/[0.015]">
        <x-container class="grid items-center gap-14 py-24 lg:grid-cols-2">
            <div class="min-w-0">
                <x-section-heading
                    eyebrow="From class to binary"
                    title="Write a command. Build a binary. Done."
                >
                    A Laravel Zero command is a plain PHP class. When you're ready to distribute it, one command
                    compiles the application — dependencies and all — into a single executable file.
                </x-section-heading>

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

            <x-code-window filename="DeployCommand.php" class="min-w-0">
<pre class="font-code overflow-x-auto p-5 text-[13px] leading-relaxed text-zinc-300"><span class="text-syntax-comment">&lt;?php</span>

<span class="text-syntax-keyword">namespace</span> App\Commands;

<span class="text-syntax-keyword">use</span> LaravelZero\Framework\Commands\Command;

<span class="text-syntax-keyword">final class</span> <span class="text-syntax-type">DeployCommand</span> <span class="text-syntax-keyword">extends</span> <span class="text-syntax-type">Command</span>
{
    <span class="text-syntax-keyword">protected</span> $signature = <span class="text-syntax-value">'deploy {env=staging}'</span>;

    <span class="text-syntax-keyword">protected</span> $description = <span class="text-syntax-value">'Deploy the application'</span>;

    <span class="text-syntax-keyword">public function</span> <span class="text-syntax-function">handle</span>(Releaser $releaser): <span class="text-syntax-keyword">void</span>
    {
        $env = $this-&gt;<span class="text-syntax-function">argument</span>(<span class="text-syntax-value">'env'</span>);

        $this-&gt;<span class="text-syntax-function">task</span>(<span class="text-syntax-value">'Building assets'</span>, $releaser-&gt;build(...));
        $this-&gt;<span class="text-syntax-function">task</span>(<span class="text-syntax-value">'Running migrations'</span>, $releaser-&gt;migrate(...));

        $this-&gt;<span class="text-syntax-function">info</span>(<span class="text-syntax-value">"Deployed to {$env}."</span>);
    }
}</pre>
            </x-code-window>
        </x-container>
    </section>

    {{-- Add-ons --}}
    <section id="addons" class="scroll-mt-16">
        <x-container class="py-24">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <x-section-heading
                    class="max-w-xl"
                    eyebrow="Opt in, never out"
                    title="Install only what you use."
                />
                <p class="font-code text-sm text-zinc-500">php my-cli app:install &lt;addon&gt;</p>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($addons as [$name, $body])
                    <div class="rounded-xl border border-white/10 bg-white/[0.02] p-5 transition hover:border-accent/25 hover:bg-white/[0.04]">
                        <p class="font-code text-sm text-white">{{ $name }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-zinc-500">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- CTA --}}
    <section class="relative overflow-hidden border-t border-white/5">
        <div class="pointer-events-none absolute -bottom-56 left-1/2 h-[480px] w-[880px] -translate-x-1/2 rounded-full bg-accent-glow/10 blur-[130px]"></div>
        <div class="relative mx-auto max-w-3xl px-6 py-28 text-center">
            <h2 class="text-4xl font-semibold tracking-[-0.02em] text-white text-balance sm:text-5xl">
                Your next CLI is one command away.
            </h2>
            <p class="mx-auto mt-5 max-w-lg leading-relaxed text-zinc-400 text-pretty">
                Free, open source and MIT licensed.
            </p>
            <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <x-button href="#install">Start building</x-button>
                <x-button variant="secondary" href="https://github.com/laravel-zero/laravel-zero">Star on GitHub</x-button>
            </div>
        </div>
    </section>
</x-layouts.app>
