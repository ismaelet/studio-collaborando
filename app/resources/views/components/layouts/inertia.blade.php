<!DOCTYPE html>
<html class="{{ $colorScheme }}" lang="{{ $lang }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ $description }}" />
    <meta property="og:image" content="{{ $thumbnail }}" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <title>{{ $title }}</title>

    @vite(['resources/js/app.ts'])

    <x-inertia::head />
</head>

<body>
    <x-inertia::app />
</body>
</html>
