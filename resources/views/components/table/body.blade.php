@props(['fields', 'records', 'buttons', 'interactiveRows'])

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

            @foreach ($fields as $field)
                <td class="align-middle">

                    @if (isset($field['name']))
                        @if ($interactiveRows)
                            <a href="/{{ Request::path() . '/' . $record->id }}">
                        @endif

                        <div class="p-4 font-medium">
                            {{ $record->{$field['name']} ?: '-' }}
                        </div>

                        @if ($interactiveRows)
                            </a>
                        @endif
                    @else
                        <x-table.buttons :$record :$buttons />
                    @endif

                </td>
            @endforeach

        </tr>
    @endforeach

</tbody>
