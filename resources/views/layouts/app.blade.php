<x-app-layout layout="base" :title="$attributes->get('title')"
              :description="$attributes->get('description')"
              class="text-cool-gray-800 leading-normal lg:px-2 font-sans"
              x-data="AppOffCanvasMenu()">
    <x-slot name="head">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        {{ $head ?? '' }}
    </x-slot>

    @include('_partials.nav')

    {{ $slot }}

    <x-slot name="footer">
        {{ $footer ?? '' }}
    </x-slot>
    @push('scripts')
        <script defer src="{{ mix('js/app.js') }}"></script>
    @endpush
</x-app-layout>
