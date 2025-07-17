<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:title" content="Fadli & Rika - Undangan Pernikahan" />
        <meta property="og:description" content="Kami mengundang Anda untuk menghadiri hari bahagia kami." />
        <meta property="og:image" content="https://fadli-dan-rika.uliyan.my.id/storage/images/share`-thumbnail.jpg" />
        <meta property="og:url" content="https://fadli-dan-rika.uliyan.my.id/" />
        <meta property="og:type" content="website" />

        <title>Rika & Fadli</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/js/app.js'])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
