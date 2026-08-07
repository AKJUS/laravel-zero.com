<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Documentation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class DocsController extends Controller
{
    /**
     * Render a documentation page.
     */
    public function __invoke(Documentation $documentation, ?string $page = null): View|RedirectResponse
    {
        if ($page === null) {
            // Permanent: "/docs" has one home, and crawlers should record it.
            return redirect()->route('docs', config('docs.default_page'), status: 301);
        }

        abort_unless($documentation->exists($page), 404);

        return view('docs.show', [
            'page' => $documentation->page($page),
            'navigation' => $documentation->navigation(),
            'neighbours' => $documentation->neighbours($page),
        ]);
    }
}
