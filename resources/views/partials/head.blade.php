<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title . ' | ' . config('app.name', 'WM Car Rental') : config('app.name', 'WM Car Rental') . ' - Car Rental in Eleuthera, Bahamas' }}
</title>

<!-- Standard SEO Meta Tags -->
<meta name="description" content="{{ $description ?? 'Rent reliable cars, SUVs, and vans in Eleuthera, Bahamas with WM Car Rental. Convenient pickup at Rock Sound (RSD) and Governor\'s Harbour (GHB) airports. Book online today!' }}" />
<link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}" />

<!-- Open Graph / Social Sharing (WhatsApp, Facebook, iMessage) -->
<meta property="og:site_name" content="{{ config('app.name', 'WM Car Rental') }}" />
<meta property="og:type" content="{{ $ogType ?? 'website' }}" />
<meta property="og:title" content="{{ filled($title ?? null) ? $title . ' | ' . config('app.name', 'WM Car Rental') : config('app.name', 'WM Car Rental') . ' - Car Rental in Eleuthera, Bahamas' }}" />
<meta property="og:description" content="{{ $description ?? 'Rent reliable cars, SUVs, and vans in Eleuthera, Bahamas with WM Car Rental. Convenient pickup at Rock Sound (RSD) and Governor\'s Harbour (GHB) airports. Book online today!' }}" />
<meta property="og:url" content="{{ $canonicalUrl ?? url()->current() }}" />
<meta property="og:image" content="{{ $ogImage ?? asset('apple-touch-icon.png') }}" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ filled($title ?? null) ? $title . ' | ' . config('app.name', 'WM Car Rental') : config('app.name', 'WM Car Rental') . ' - Car Rental in Eleuthera, Bahamas' }}" />
<meta name="twitter:description" content="{{ $description ?? 'Rent reliable cars, SUVs, and vans in Eleuthera, Bahamas with WM Car Rental. Convenient pickup at Rock Sound (RSD) and Governor\'s Harbour (GHB) airports. Book online today!' }}" />
<meta name="twitter:image" content="{{ $ogImage ?? asset('apple-touch-icon.png') }}" />

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">

@fonts

@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@fluxAppearance
