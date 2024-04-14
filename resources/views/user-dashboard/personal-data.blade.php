@php
    $user = Auth::user();
@endphp

<x-user-dashboard :$title>

    <x-user-dashboard.panel icon="user" title="Dati personali">
        <div class="grid gap-12">

            @if (session('success'))
                <x-inputs.alert-success>{{ session('success') }}</x-inputs.alert-success>
            @endif

            <form class="grid gap-6" method="POST">
                @csrf

                <x-typography.component-heading>I miei dati</x-typography.component-heading>

                <x-form.group>
                    <x-inputs.label>Nome completo:</x-inputs.label>
                    <x-inputs.input name="first_name" value="{{ $user->first_name }}" placeholder="Nome" required
                        :size="2" />
                    <x-inputs.input name="last_name" value="{{ $user->last_name }}" placeholder="Cognome" required
                        :size="2" />
                </x-form.group>

                <x-form.group>
                    <x-inputs.label>Indirizzo e-mail:</x-inputs.label>
                    <x-inputs.input type="email" name="email" :value="$user->email" label="Indirizzo e-mail" />
                </x-form.group>

                <x-inputs.button type="submit" name="edit-personal-data" variant="secondary"
                    size="small">Modifica</x-inputs.button>
            </form>

            <form class="grid gap-6" method="POST">
                @csrf

                <x-typography.component-heading>Modifica la password</x-typography.component-heading>

                <x-form.group>
                    <x-inputs.label>Password vecchia:</x-inputs.label>
                    <x-inputs.input name="old_password" placeholder="Password precedente" required size="2" />
                </x-form.group>

                <x-form.group>
                    <x-inputs.label>Nuova password:</x-inputs.label>
                    <x-inputs.input name="password" placeholder="Nuova password" required size="2" />
                    <x-inputs.input name="password_confirmation" placeholder="Conferma la nuova password" required
                        size="2" />
                </x-form.group>

                <x-inputs.button type="submit" variant="secondary" size="small">Modifica</x-inputs.button>
            </form>
        </div>
    </x-user-dashboard.panel>

</x-user-dashboard>
