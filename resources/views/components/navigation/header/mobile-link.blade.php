@push('styles')
    <style>
        .mobile-navigation__link {
            letter-spacing: 0.05em;
            transition: color 0.2s;

            &:hover {
                color: var(--fc-700);
            }
        }
    </style>
@endpush

<li class="mobile-navigation__link ff-titles">
    <a href="{{ route($link['url']) }}">{{ is_string($link['label']) ? $link['label'] : $link['label'][0] }}</a>
</li>
