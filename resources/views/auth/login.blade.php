<x-templates.auth :$title>
    {{-- Body --}}
    <x-slot:body>
        <div class="form-field" data-on-enter-view data-enter-animation="direction: bottom, delay: 200">
            <x-form.open-input type="email" name="email" value="{{ old('email') }}" placeholder="Indirizzo e-mail"
                required />

            @error('email')
                <x-form.input-warning>{{ $message }}</x-form.input-warning>
            @enderror
        </div>

        <div class="form-field" data-on-enter-view data-enter-animation="direction: bottom, delay: 400">
            <x-form.open-input type="password" name="password" value="" placeholder="Password" required />

            @error('password')
                <x-form.input-warning>{{ $message }}</x-form.input-warning>
            @enderror
        </div>

        @if (session('status'))
            <x-form.input-warning class="text-left">{{ session('status') }}</x-form.input-warning>
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
            <x-form.button class="w-full" type="submit">Login</x-form.button>
        </div>

        <div data-on-enter-view data-enter-animation="direction: bottom, delay: 400">
            <x-form.button class="w-full" href="{{ route('register') }}" variant="secondary">Registrati</x-form.button>
        </div>
    </x-slot:footer>

    {{-- Welcome Section --}}
    <x-slot:welcome>
        <div class="welcome__image" style="{{ set_background_image('auth/login-image.webp') }}"></div>
    </x-slot:welcome>
</x-templates.auth>
