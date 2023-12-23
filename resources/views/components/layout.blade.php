<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? $appDescription }}">
    <meta property="og:image" content="{{ Vite::image('thumbnail.jpg') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ isset($title) ? $title . ' | ' . $appName : $appName }}</title>

    <livewire:styles />
    @vite(['resources/css/main.css', 'resources/js/main.js'])
    @stack('styles')

</head>

<body>
    {{ $slot }}

    <livewire:scripts />
</body>

</html>
