<x-layouts.admin-dashboard>

    <x-dashboard.typography.main-heading title="Dashboard" />

    <div class="grid gap-4 mt-8">
        {{-- Row 1 --}}
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">

            {{-- Total revenue --}}
            <x-dashboard.widget.total-revenue />

            {{-- Total sales --}}
            <x-dashboard.widget.total-sales />

            {{-- New users --}}
            <x-dashboard.widget.new-users />

            {{-- New newsletter subscribers --}}
            <x-dashboard.widget.new-newsletter-subscribers />
        </div>

        {{-- Row 2 --}}
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">

            {{-- Revenue graph --}}
            <x-dashboard.widget.revenue-graph />

            {{-- New user list --}}
            <x-dashboard.widget.new-user-list />

        </div>
    </div>
</x-layouts.admin-dashboard>
