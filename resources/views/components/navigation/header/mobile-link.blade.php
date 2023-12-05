@pushOnce('styles')
    <style>
        .mobile-navigation__link {
            letter-spacing: 0.05em;
            transition: color 0.2s;
        }
    </style>
@endPushOnce

<li class="mobile-navigation__link font-heading text-lg">
    <a href="{{ route($link['url']) }}">{{ is_string($link['label']) ? $link['label'] : $link['label'][0] }}</a>
</li>
