@props([
    'title' => null,
    'description' => null,
    'type' => 'website',
    'indexable' => true,
    'schema' => [],
])

@php
    use App\Support\Seo;

    $siteName = config('seo.site_name');

    $documentTitle = $title
        ? $title.' — '.$siteName
        : $siteName.' — '.config('seo.tagline');

    $documentDescription = $description ?: config('seo.description');

    // Canonicals are built from the configured host, never the request one,
    // so a preview deployment cannot canonicalise itself.
    $canonical = Seo::url(request()->path());

    $image = config('seo.image');
    $imageUrl = Seo::url($image['path']);
@endphp

<title>{{ $documentTitle }}</title>
<meta name="description" content="{{ $documentDescription }}">
<link rel="canonical" href="{{ $canonical }}">

@if ($indexable)
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
@else
    <meta name="robots" content="noindex, nofollow">
@endif

<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="en_US">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $documentTitle }}">
<meta property="og:description" content="{{ $documentDescription }}">
<meta property="og:image" content="{{ $imageUrl }}">
<meta property="og:image:type" content="{{ $image['type'] }}">
<meta property="og:image:width" content="{{ $image['width'] }}">
<meta property="og:image:height" content="{{ $image['height'] }}">
<meta property="og:image:alt" content="{{ $image['alt'] }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $documentTitle }}">
<meta name="twitter:description" content="{{ $documentDescription }}">
<meta name="twitter:image" content="{{ $imageUrl }}">
<meta name="twitter:image:alt" content="{{ $image['alt'] }}">

<meta name="theme-color" content="{{ config('seo.theme_color') }}">
<meta name="color-scheme" content="dark">

<link rel="icon" href="/favicon.ico" sizes="32x32">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">

<script type="application/ld+json">{!! Seo::linkedData($schema) !!}</script>
