@push('styles')
    <style>
        .welcome__image {
            background-position: 70% 100%;
            background-size: auto 150%;

            @media (min-width: 769px) {
                background-position: 100% 100%;
                background-size: cover;
            }
        }
    </style>
@endpush

<x-templates.auth :$title>
    {{-- Body --}}
    <x-slot:body>
        <div class="form-field">
            <input class="open-input" type="email" name="email" value="{{ old('email') }}" placeholder="" required>

            @error('email')
                <p class="error-warning">{{ error }}</p>
            @enderror
        </div>

        <div class="form-field">
            <input class="open-input" type="password" name="password" value="" placeholder="" required>

            @error('password')
                <p class="error-warning">{{ error }}</p>
            @enderror
        </div>

        @if (session('status'))
            <p class="error-warning">{{ session('status') }}</p>
        @endif
    </x-slot:body>

    {{-- Footer --}}
    <x-slot:footer>
        <button type="submit" class="button">Login</button>
        <a href="{{ route('register') }}" class="button button--secondary">Registrati</a>
    </x-slot:footer>

    {{-- Welcome Section --}}
    <x-slot:welcome>
        <div class="welcome__image fill-all background-fill">
        </div>
    </x-slot:welcome>
</x-templates.auth>
