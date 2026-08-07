import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                // Only the weights rendered above the fold are preloaded; the
                // rest still get @font-face rules and load on demand.
                bunny('Instrument Sans', {
                    weights: [400, 500, 600, 700],
                    preload: [{ weight: 400 }, { weight: 600 }],
                }),
                bunny('JetBrains Mono', {
                    weights: [400, 500, 700],
                    preload: [{ weight: 400 }],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
