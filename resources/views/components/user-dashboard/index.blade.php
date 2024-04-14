@props(['title' => 'Profilo'])

@push('styles')
    <style>
        .dashboard-body {

            @media (min-width: 768px) {
                grid-template-columns: 18rem 1fr
            }
        }
    </style>
@endpush

<x-layouts.main :$title>
    <div class="dashboard-body grid content-center gap-12 my-8 md:my-20">

        <div>
            <x-user-dashboard.navigation />
        </div>

        <div class="grid gap-8 content-start">
            {{ $slot }}
        </div>

    </div>
</x-layouts.main>
