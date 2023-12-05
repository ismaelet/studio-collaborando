<nav class="desktop-navigation">
    <ul class="flex-group" data-spacing="700">
        @foreach (config('custom.header_navigation_links') as $link)
            <x-navigation.header.desktop-link :$link />
        @endforeach
    </ul>
</nav>
