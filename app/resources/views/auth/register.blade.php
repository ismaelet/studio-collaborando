@push('styles')
    <style>
        .welcome__image {
            background-position: left;
            background-size: 150% auto;

            @media (min-width: 769px) {
                background-position: right;
                background-size: cover;
            }
        }
    </style>
@endpush

<x-layouts.auth :$title>
    {{-- Body --}}
    <x-slot:body>
        <div class="grid gap-2 text-left">
            <x-inputs.label>Nome completo:</x-inputs.label>
            <x-inputs.input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Nome" required />

            @error('first_name')
                <x-inputs.warning>{{ $message }}</x-inputs.warning>
            @enderror

            <x-inputs.input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Cognome" required />

            @error('last_name')
                <x-inputs.warning>{{ $message }}</x-inputs.warning>
            @enderror
        </div>

        <div class="grid gap-2 text-left">
            <x-inputs.label>Indirizzo e-mail:</x-inputs.label>
            <x-inputs.input type="email" name="email" value="{{ old('email') }}" placeholder="Indirizzo e-mail"
                required />

            @error('email')
                <x-inputs.warning>{{ $message }}</x-inputs.warning>
            @enderror
        </div>

        <div class="grid gap-2 text-left">
            <x-inputs.label>Password:</x-inputs.label>
            <x-inputs.input type="password" name="password" value="" placeholder="Password" required />
            <x-inputs.input type="password" name="password_confirmation" value=""
                placeholder="Conferma la password" required />

            @error('password')
                <x-inputs.warning>{{ $message }}</x-inputs.warning>
            @enderror
        </div>
    </x-slot:body>

    {{-- Footer --}}
    <x-slot:footer>
        <x-inputs.button type="submit">Registrati</x-inputs.button>
        <x-inputs.button href="{{ route('login') }}" variant="secondary">Hai già un account?</x-inputs.button>
    </x-slot:footer>

    {{-- Welcome Section --}}
    <x-slot:welcome>
        <div class="welcome__image" style="{{ set_background_image('auth/register-image.webp') }}"></div>
    </x-slot:welcome>
</x-layouts.auth>
