<?php

use App\Http\Controllers\DocsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/docs/{page?}', DocsController::class)
    ->where('page', '[a-z0-9-]+')
    ->name('docs');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::view('/designs', 'designs.index')->name('designs.index');

Route::view('/designs/midnight', 'designs.midnight')->name('designs.midnight');
Route::view('/designs/editorial', 'designs.editorial')->name('designs.editorial');
Route::view('/designs/prism', 'designs.prism')->name('designs.prism');
Route::view('/designs/blueprint', 'designs.blueprint')->name('designs.blueprint');
