@extends('auth')

{{-- Title --}}
@section('title', 'Registrati')

{{-- Body --}}
@section('form-body')
    <div class="form-field">
        <label for="name" class="label">Nome completo</label>

        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Nome" required>

        @error('first_name')
            <p class="error-warning">{{ error }}</p>
        @enderror

        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Cognome" required>

        @error('last_name')
            <p class="error-warning">{{ error }}</p>
        @enderror
    </div>

    <div class="form-field">
        <label for="email" class="label">Indirizzo e-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Indirizzo e-mail" required>

        @error('email')
            <p class="error-warning">{{ error }}</p>
        @enderror
    </div>

    <div class="form-field">
        <label for="password" class="label">Password:</label>
        <input type="password" name="password" value="" placeholder="Password" required>
        <input type="password" name="password_confirmation" value="" placeholder="Conferma la password" required>

        @error('password')
            <p class="error-warning">{{ error }}</p>
        @enderror
    </div>
@endsection

{{-- Footer --}}
@section('form-footer')
    <button type="submit" class="button">Registrati</button>
    <a href="{{ route('login') }}" class="button button--secondary">Indietro</a>
@endsection

{{-- Welcome section --}}
@section('welcome-section')
    <div class="welcome__image fill-all background-fill" {!! StyleHelper::setBackgroundImage('auth/register-background.webp') !!}>
    </div>
@endsection

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
