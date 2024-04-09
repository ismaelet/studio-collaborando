@php
    $user = Auth::user();
@endphp

<x-templates.user-dashboard :$title>

    <x-user-dashboard.panel icon="user" title="Dati personali">
        <div class="grid gap-12">

            @if (session('success'))
                <x-form.success-message>{{ session('success') }}</x-form.success-message>
            @endif

            <form class="grid gap-6" method="POST">
                @csrf

                <x-typography.component-heading>I miei dati</x-typography.component-heading>

                <x-form.group>
                    <x-form.label>Nome completo:</x-form.label>
                    <x-form.input name="first_name" value="{{ $user->first_name }}" placeholder="Nome" required
                        :size="2" />
                    <x-form.input name="last_name" value="{{ $user->last_name }}" placeholder="Cognome" required
                        :size="2" />
                </x-form.group>

                <x-form.group>
                    <x-form.label>Indirizzo e-mail:</x-form.label>
                    <x-form.input type="email" name="email" :value="$user->email" label="Indirizzo e-mail" />
                </x-form.group>

                <x-form.button type="submit" name="edit-personal-data" variant="secondary"
                    size="small">Modifica</x-form.button>
            </form>

            <form class="grid gap-6" method="POST">
                @csrf

                <x-typography.component-heading>Modifica la password</x-typography.component-heading>

                <x-form.group>
                    <x-form.label>Password vecchia:</x-form.label>
                    <x-form.input name="old_password" placeholder="Password precedente" required size="2" />
                </x-form.group>

                <x-form.group>
                    <x-form.label>Nuova password:</x-form.label>
                    <x-form.input name="password" placeholder="Nuova password" required size="2" />
                    <x-form.input name="password_confirmation" placeholder="Conferma la nuova password" required
                        size="2" />
                </x-form.group>

                <x-form.button type="submit" variant="secondary" size="small">Modifica</x-form.button>
            </form>
        </div>
    </x-user-dashboard.panel>

</x-templates.user-dashboard>
