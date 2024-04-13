<x-templates.admin-dashboard>

    <div class="grid gap-8">
        {{-- Title bar --}}
        <x-dashboard.title-bar :$title />

        {{-- Table --}}
        <x-table.container :$columns :$records :$recordCount :$orderBy :$orderDirection :$buttons :$pageSize />
    </div>

</x-templates.admin-dashboard>
