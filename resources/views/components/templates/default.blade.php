<x-layout>
    <x-navigation.default-header :config="$headerConfig ?? []" />

    <main>{{ $slot }}</main>
</x-layout>
