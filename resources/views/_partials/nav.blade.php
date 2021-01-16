<header class="flex items-center shadow-sm bg-white py-4" role="banner">
    <div class="container flex items-center mx-auto px-6 space-x-4" >
        <div class="flex items-center lg:hidden">
            <button aria-label="Toggle Documentation Navigation" @click.prevent="toggle()">
                <x-i.menu class="h-6 w-6 md:h-8 md:w-8 text-gray-500 opacity-50"></x-i.menu>
            </button>
        </div>

        <div class="flex items-center">
            <a href="/" title="{{ config('app.name')}} home" class="inline-flex items-center">
                <img class="h-8" loading="lazy" src="/assets/img/logo.svg" alt="{{ config('app.name')}} logo" />
            </a>
        </div>

        <div class="flex flex-1 justify-end items-center text-right">
            <div id="docsearch"></div>

            <div class="hidden lg:flex">
                @include('_partials.nav-items')
            </div>
        </div>
    </div>
</header>
