<div class="grid content-start gap-4">
    <h3
        class="main-footer__column-title pl-2 border-l-4 border-secondary text-neutral-700 font-heading uppercase font-medium tracking-wide text-lg">
        {{ $title }}</h3>

    @foreach ($data as $link)
        @if (isset($link['social_media']))
            <x-navigation.footer.link :href="config('custom.social_media.' . $link['social_media'] . '.url')" :icon="isset($link['icon']) ? $link['social_media'] : null">
                {{ config('custom.social_media.' . $link['social_media'] . '.label') }}
            </x-navigation.footer.link>
        @else
            <x-navigation.footer.link :href="isset($link['url']) ? route($link['url']) : null">
                {{ $link['label'] }}
            </x-navigation.footer.link>
        @endif
    @endforeach
</div>
