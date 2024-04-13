@props(['columns', 'orderBy', 'orderDirection'])

<thead class="">
    <tr class="">
        @foreach ($columns as $column)
            <x-table.header-cell :$column :$orderBy :$orderDirection />
        @endforeach
    </tr>
</thead>
