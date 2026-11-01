@props(['title' => '', 'icon' => null])

<section {{ $attributes->class(['user-dashboard-panel', 'surface', 'p-content-padding']) }}>

    {{-- Panel header --}}
    <div class="flex gap-4 items-center pb-content-padding mb-content-padding border-b">
        <span class="w-6 aspect-square text-secondary-400">
            {{ import_svg('icons/' . $icon) }}
        </span>

        <x-typography.component-heading>{{ $title }}</x-typography.component-heading>
    </div>

    {{-- Panel body --}}
    <div class="">
        {{ $slot }}
    </div>
</section>
