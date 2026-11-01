<x-layouts.auth :$title>
    {{-- Body --}}
    <x-slot:body>
        <div class="form-field" data-on-enter-view data-enter-animation="direction: bottom, delay: 200">
            <x-inputs.open-input type="email" name="email" value="{{ old('email') }}" placeholder="Indirizzo e-mail"
                required />

            @error('email')
                <x-inputs.warning>{{ $message }}</x-inputs.warning>
            @enderror
        </div>

        <div class="form-field" data-on-enter-view data-enter-animation="direction: bottom, delay: 400">
            <x-inputs.open-input type="password" name="password" value="" placeholder="Password" required />

            @error('password')
                <x-inputs.warning>{{ $message }}</x-inputs.warning>
            @enderror
        </div>

        @if (session('status'))
            <x-inputs.warning class="text-left">{{ session('status') }}</x-inputs.warning>
        @endif

        <p class="text-right" data-on-enter-view data-enter-animation="direction: bottom, delay: 450">
            <a class="" href="{{ route('auth.recover') }}">
                Hai dimenticato i dati di
                accesso?
            </a>
        </p>
    </x-slot:body>

    {{-- Footer --}}
    <x-slot:footer>
        <div data-on-enter-view data-enter-animation="direction: bottom, delay: 200">
            <x-inputs.button class="w-full" type="submit">Login</x-inputs.button>
        </div>

        <div data-on-enter-view data-enter-animation="direction: bottom, delay: 400">
            <x-inputs.button class="w-full" href="{{ route('register') }}"
                variant="secondary">Registrati</x-inputs.button>
        </div>
    </x-slot:footer>

    {{-- Welcome Section --}}
    <x-slot:welcome>
        <div class="welcome__image" style="{{ set_background_image('auth/login-image.webp') }}"></div>
    </x-slot:welcome>
</x-layouts.auth>
