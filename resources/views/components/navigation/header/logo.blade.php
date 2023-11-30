<a href="{{ route('home') }}" class="main-header__logo">
    {{ import_svg('logo/header-logo') }}
</a>

@push('styles')
    <style>
        .main-header__logo {
            width: 3.5rem;
            height: auto;

            [data-local-theme="dark"] & .fc-700 {
                fill: currentColor;
            }
        }
    </style>
@endpush
