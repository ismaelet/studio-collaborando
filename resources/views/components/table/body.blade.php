@props(['columns', 'records', 'buttons'])

@pushOnce('styles')
    <style>
        [data-color-scheme="light"] {
            .table-row:hover {
                background-color: var(--color-surface-500);
            }
        }
    </style>
@endpushOnce

<tbody>
    @foreach ($records as $record)
        <tr class="table-row border-t transition-colors hover:bg-surface-400">

            @foreach ($columns as $column)
                <td class="align-middle">

                    @if (isset($column['name']))
                        <a href="/{{ Request::path() . '/' . $record->id }}">
                            <div class="p-4 font-medium">
                                <x-table.cell :$record :$column />
                            </div>
                        </a>
                    @else
                        <x-table.buttons :$record :$buttons />
                    @endif

                </td>
            @endforeach

        </tr>
    @endforeach

</tbody>
