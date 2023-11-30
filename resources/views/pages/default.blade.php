@extends('layout')

@section('content')
    <div class="main-container">
        <livewire:navigation.main-header />

        <main>
            @yield('page-content')
        </main>
    </div>
@endsection

@push('styles')
    {!! StyleHelper::includeStyle('templates/default') !!}
@endpush
