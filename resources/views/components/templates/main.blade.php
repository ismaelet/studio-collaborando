@push('styles')
    <style>
        .main-content {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            grid-template-areas:
                'header'
                'main';
            grid-template-rows: max-content 1fr;
            min-height: 100svh;
        }
    </style>
@endpush

<x-layout>
    <div class="main-content">
        <x-navigation.default-header :config="$headerConfig ?? []" />

        <main>{{ $slot }}</main>
    </div>

    <x-navigation.default-footer />
</x-layout>
