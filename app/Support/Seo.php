<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Builds absolute URLs from the canonical host configured in "config/seo.php"
 * rather than from the incoming request, so canonicals, sitemap entries and
 * linked data all agree on a single address for every page.
 */
final class Seo
{
    public static function url(string $path = '/'): string
    {
        return rtrim((string) config('seo.url'), '/').'/'.ltrim($path, '/');
    }

    /**
     * The site-wide linked data nodes every page carries.
     *
     * @return list<array<string, mixed>>
     */
    public static function graph(): array
    {
        return [
            [
                '@type' => 'WebSite',
                '@id' => self::url('#website'),
                'url' => self::url(),
                'name' => config('seo.site_name'),
                'description' => config('seo.description'),
                'inLanguage' => 'en',
                'publisher' => ['@id' => self::url('#organization')],
            ],
            [
                '@type' => 'Organization',
                '@id' => self::url('#organization'),
                'name' => config('seo.site_name'),
                'url' => self::url(),
                'description' => config('seo.description'),
                'sameAs' => [config('seo.organization'), config('seo.repository')],
            ],
        ];
    }

    /**
     * Serialise the site-wide graph plus any page-specific nodes.
     *
     * Assembled here rather than in the view because "@context" is also a
     * Blade directive, and Blade would compile the key out of the array.
     *
     * @param  list<array<string, mixed>>  $schema
     */
    public static function linkedData(array $schema = []): string
    {
        return (string) json_encode(
            [
                '@context' => 'https://schema.org',
                '@graph' => [...self::graph(), ...$schema],
            ],
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_PRETTY_PRINT,
        );
    }
}
