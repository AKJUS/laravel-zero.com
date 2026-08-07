<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Documentation Version
    |--------------------------------------------------------------------------
    |
    | The branch of the laravel-zero/docs repository that is rendered by the
    | site. Content lives in "resources/docs/{version}" and is pulled in by
    | "bin/checkout_latest_docs.sh" rather than committed to this project.
    |
    */

    'version' => env('DOCS_VERSION', 'master'),

    /*
    |--------------------------------------------------------------------------
    | Default Page
    |--------------------------------------------------------------------------
    |
    | The page visitors land on when they open "/docs" without naming one.
    |
    */

    'default_page' => 'introduction',

    /*
    |--------------------------------------------------------------------------
    | Excluded Pages
    |--------------------------------------------------------------------------
    |
    | Markdown files that live in the docs repository but are not pages of
    | their own. "documentation" is the sidebar index itself.
    |
    */

    'excluded' => ['readme', 'license', 'documentation'],

];
