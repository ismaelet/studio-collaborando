<x-form :title="$title">
    <x-slot:body>
        <p class="text-center">
            Desideri davvero disconnetterti?
        </p>
    </x-slot:body>

    <x-slot:footer>
        <x-inputs.button type="submit" variant="primary">Esci</x-inputs.button>
        <x-inputs.button href="{{ route('user-dashboard') }}" variant="secondary">Indietro</x-inputs.button>
    </x-slot:footer>
</x-form>
