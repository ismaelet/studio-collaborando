@php
    $currentLocation = $locationTag ?? Request::route()->getName();
@endphp

@push('styles')
    <style>
        .desktop-navigation__link {
            padding-block: 1.25em;
            font-weight: var(--fw-regular);
            line-height: normal;

            &.active[data-type="link"] {
                font-weight: var(--fw-semibold);
            }

            & a::after {
                content: '';
                display: block;
                width: 1.5rem;
                height: 2px;
                background-color: currentColor;
                scale: 0 1;
                transform-origin: left;
                transition: scale .2s;
            }

            &.active a::after,
            & a:hover::after {
                scale: 1;
            }
        }

        .desktop-navigation__link[data-type="button"] {
            padding: 0;

            & a {
                border: var(--border-width) solid currentColor;
                padding: .75rem 2rem;
                border-radius: var(--border-radius-1000);
            }

            & a::after {
                content: none;
            }
        }
    </style>
@endpush

<li class="desktop-navigation__link ff-titles {{ $link['location_tag'] == $currentLocation ? 'active' : '' }}"
    data-type="{{ $link['type'] }}">
    <a href="{{ route($link['url']) }}">{{ is_string($link['label']) ? $link['label'] : $link['label'][0] }}</a>
</li>
