@props(['navigationGroups', 'theme' => null, 'colorScheme' => null])

@pushOnce('styles')
    <style>
        main {
            display: grid;
            grid-template-columns: max-content minmax(0, 1fr);
        }
    </style>
@endpushOnce

<x-templates.empty :$theme :$colorScheme>
    <!-- Navigation bar -->
    <x-dashboard.navigation :navigation-groups="$navigationGroups" />
    <!-- Body -->
    <section class="min-h-svh p-8">
        <div class="min-w-64">

            {{ $slot }}

        </div>
    </section>
</x-templates.empty>
