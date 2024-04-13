@props(['columns', 'records', 'orderBy', 'orderDirection', 'buttons'])

<section class="p-8 border rounded">
    <table class="w-full">
        {{--  Table head  --}}
        <x-table.header :$columns :$orderBy :$orderDirection />

        {{-- Table body --}}
        <x-table.body :$columns :$records :$buttons />
    </table>
</section>
