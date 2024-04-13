@props(['theme' => null, 'colorScheme' => null])

@push('styles')
    <style>
        main {
            display: grid;
            min-height: 100svh;
        }

        @supports not (min-height: 100svh) {
            main {
                min-height: 100vh;
            }
        }
    </style>
@endpush

<x-layout :$theme :$colorScheme>

    <main>{{ $slot }}</main>

</x-layout>
