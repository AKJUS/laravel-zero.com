<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Canonical URL
    |--------------------------------------------------------------------------
    |
    | Every canonical link, sitemap entry, and social card URL is built from
    | this base rather than from the incoming request, so a preview domain
    | or a "www" host can never compete with production in the index.
    |
    */

    'url' => env('SEO_URL', env('APP_URL', 'https://laravel-zero.com')),

    /*
    |--------------------------------------------------------------------------
    | Site Identity
    |--------------------------------------------------------------------------
    |
    | The name and tagline that title tags, Open Graph cards and the linked
    | data graph are assembled from. The tagline is the landing page hero,
    | kept word for word so the search result reads like the site does.
    |
    */

    'site_name' => 'Laravel Zero',

    'tagline' => 'Console applications, without the ceremony',

    'description' => 'Laravel Zero is a micro-framework for crafting beautiful command-line applications, powered by the Laravel components you already know. Write a command, ship a single binary.',

    /*
    |--------------------------------------------------------------------------
    | Social Card
    |--------------------------------------------------------------------------
    |
    | The preview image shown when a page is shared. Dimensions are declared
    | alongside it because crawlers that cannot fetch the file up front use
    | them to reserve the card, which keeps the large summary layout.
    |
    */

    'image' => [
        'path' => '/og.png',
        'width' => 1200,
        'height' => 630,
        'type' => 'image/png',
        'alt' => 'Laravel Zero — console applications, without the ceremony.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | The surface colour browsers paint their chrome with, matched to the
    | "--color-surface" design token so the address bar never flashes a
    | different black than the page it sits above.
    |
    */

    'theme_color' => '#08090a',

    /*
    |--------------------------------------------------------------------------
    | Repository
    |--------------------------------------------------------------------------
    |
    | Used by the linked data graph to tie the site to the source it renders.
    |
    */

    'repository' => 'https://github.com/laravel-zero/laravel-zero',

    'organization' => 'https://github.com/laravel-zero',

];
