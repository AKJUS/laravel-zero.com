<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Documentation;
use App\Support\Seo;
use Illuminate\Http\Response;

final class SitemapController extends Controller
{
    /**
     * Render the sitemap.
     *
     * The landing page and every page reachable from the documentation
     * sidebar. Design explorations are deliberately absent: they carry a
     * "noindex" of their own and are not part of the public site.
     */
    public function __invoke(Documentation $documentation): Response
    {
        $urls = [
            ['loc' => Seo::url(), 'lastmod' => null, 'priority' => '1.0'],
        ];

        foreach ($documentation->pages() as $page) {
            $urls[] = [
                'loc' => Seo::url('docs/'.$page['slug']),
                'lastmod' => $documentation->lastModified($page['slug'])->toAtomString(),
                'priority' => $page['slug'] === config('docs.default_page') ? '0.9' : '0.8',
            ];
        }

        // The XML declaration is prepended here rather than authored in the
        // view: Blade tokenises a leading "<?xml" as a PHP open tag when
        // "short_open_tag" is enabled, and leaves the line uncompiled.
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .view('sitemap', ['urls' => $urls])->render();

        return response($xml)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
