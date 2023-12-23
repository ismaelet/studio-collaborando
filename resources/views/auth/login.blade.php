@push('styles')
    <style>
        .welcome__image {
            background-position: 100% 100%;
            background-size: cover;

            @media (max-width: 768px) {
                min-height: 25rem;
            }
        }
    </style>
@endpush

<x-templates.auth :$title>
    {{-- Body --}}
    <x-slot:body>
        <div class="form-field">
            <x-form.open-input type="email" name="email" value="{{ old('email') }}" placeholder="" required />

            @error('email')
                <x-form.error-warning>{{ error }}</x-form.error-warning>
            @enderror
        </div>

        <div class="form-field">
            <x-form.open-input type="password" name="password" value="" placeholder="" required />

            @error('password')
                <x-form.error-warning>{{ error }}</x-form.error-warning>
            @enderror
        </div>

        @if (session('status'))
            <x-form.error-warning class="text-left">{{ session('status') }}</x-form.error-warning>
        @endif
    </x-slot:body>

    {{-- Footer --}}
    <x-slot:footer>
        <x-form.button type="submit">Login</x-form.button>
        <x-form.button href="{{ route('register') }}" scheme="secondary">Registrati</x-form.button>
    </x-slot:footer>

    {{-- Welcome Section --}}
    <x-slot:welcome>
        <div class="welcome__image" style="{{ set_background_image('auth/login-image.webp') }}"></div>
    </x-slot:welcome>
</x-templates.auth>
