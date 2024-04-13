@props([
    'columns',
    'records',
    'recordCount',
    'orderBy' => 'id',
    'orderDirection' => 'desc',
    'buttons',
    'searchBar' => true,
    'pageSize' => 50,
])

<form class="grid gap-8" method="GET">

    @if ($searchBar)
        {{-- Search bar --}}
        <x-table.search-bar />
    @endif

    {{-- Top pagination --}}
    <x-pagination.layout :$recordCount :$pageSize />

    {{-- Table --}}
    <x-table.table :$columns :$orderBy :$orderDirection :$records :$buttons />

    {{-- Bottom pagination --}}
    <x-pagination.layout :$recordCount :$pageSize />
</form>
