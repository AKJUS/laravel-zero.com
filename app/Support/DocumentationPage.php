<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonImmutable;

final readonly class DocumentationPage
{
    /**
     * @param  list<array{id: string, title: string, level: int}>  $tableOfContents
     */
    public function __construct(
        public string $slug,
        public string $title,
        public ?string $description,
        public string $contents,
        public array $tableOfContents,
        public CarbonImmutable $lastModified,
    ) {}
}
