<x-templates.form :title="$title">

    <x-slot name="body">

        @if (session('submitted'))
            <p class="font-semibold text-center text-lg">Password cambiata con successo!</p>
        @else
            <p class="">
                Inserisci qui sotto la nuova password desiderata:
            </p>

            @if (session('error'))
                <p class="error-warning">Le password inserite non corrispondono</p>
            @endif

            <x-form.input type="hidden" name="security_code" :value="$securityCode" />
            <x-form.input type="hidden" name="user_id" :value="$userId" />
            <x-form.input type="password" name="password" placeholder="Nuova password" required />
            <x-form.input type="password" name="password_confirmation" placeholder="Conferma la nuova password"
                required />
        @endif

    </x-slot>

    <x-slot name="footer">

        @if (!session('submitted'))
            {{-- If the form hasn't been submitted or the email is not found --}}
            <x-form.button type="submit">Reimposta la password</x-form.button>
        @endif

        <x-form.button variant="secondary" :href="route('login')">{{ __('Torna al login') }}</x-form.button>

    </x-slot>

</x-templates.form>
