@php
    $user = Auth::user();

    $directory = public_storage('free');
    $freeMaterials = array_map(function ($file) {
        return explode(public_storage(), $file)[1];
    }, glob($directory . '/*.pdf'));
@endphp

<x-templates.user-dashboard>

    <x-user-dashboard.panel :icon="'user'" :title="'Account'">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <h4 class="text-xl font-heading mb-2">I miei dati</h4>

                @if ($user->fullName())
                    <p>Nominativo: <span class="font-semibold">{{ $user->fullName() }}</span></p>
                @endif

                <p>Indirizzo e-mail: <span class="font-semibold break-words">{{ $user->email }}</span></p>
            </div>

            <div>
                <x-form.button href="{{ route('user-dashboard.personal-data') }}" variant="secondary"
                    size="small">Modifica</x-form.button>
            </div>
        </div>
    </x-user-dashboard.panel>

    <x-user-dashboard.panel :icon="'documents'" :title="'Materiali gratuiti'">
        <div class="grid gap-2">
            @foreach ($freeMaterials as $material)
                <p>
                    <a href="{{ public_asset($material) }}" download
                        class="flex gap-2 items-center italic font-medium w-fit">

                        <span class="w-3 text-primary">
                            {{ import_svg('icons/download') }}
                        </span>

                        {{ pathinfo($material, PATHINFO_FILENAME) }}
                    </a>
                </p>
            @endforeach
        </div>
    </x-user-dashboard.panel>

</x-templates.user-dashboard>
