@push('styles')
    <style>
        .slider {
            grid-column: full-width;
            background-color: #aaa;

            @media (min-width: 1024px) {
                min-height: 45rem;
            }
        }

        .slider__background {
            filter: saturate(1.4);
        }

        .slider__content {
            @media (min-width: 1024px) {
                grid-template-areas:
                    'contacts body scroller';
                grid-template-columns: max-content 1fr max-content;
            }
        }

        .slider__contacts {
            grid-area: contacts;
        }

        .slider__body {
            grid-area: body;
        }

        .slider__scroller {
            grid-area: scroller;
        }

        .slider-bar {
            width: 1px;
            height: 5rem;
            background: rgba(255, 255, 255, 0.30);
        }

        .slider-bar--hidden {
            background-color: transparent;
        }

        .slider__explore {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transition: translate 0.3s;

            .slider__scroller:hover & {
                translate: 0 0.5rem;
            }
        }
    </style>
@endpush

<div class="slider grid stack-content min-h-full text-neutral-light-100" data-local-theme="dark">

    {{-- Background --}}
    <div class="slider__background bg-center bg-cover opacity-50"
        style="{{ set_background_image('home/slider-background.webp') }}"></div>

    <div class="slider__content grid items-center min-h-full sm:px-8 relative">
        {{-- Contacts --}}
        <aside class="slider__contacts gap-8 justify-items-center hidden lg:grid">
            <div class="slider-bar"></div>

            @foreach (config('custom.social_media') as $contactSlug => $contact)
                <a href="{{ $contact['url'] }}"
                    class="slider__contact w-6 aspect-square flex justify-center hover:text-primary transition-colors"
                    target="_blank">
                    {{ import_svg('icons/contacts/' . $contactSlug) }}
                </a>
            @endforeach

            <div class="slider-bar slider-bar--hidden"></div>
        </aside>

        {{-- Body --}}
        <div class="slider__body grid gap-20 py-16 text-center justify-items-center mt-8">
            <div class="grid gap-12 lg:gap-20">
                <x-typography.main-heading class="text-neutral-light-100">Studio
                    Collaborando</x-typography.main-heading>
                <p class="font-heading text-base md:text-2xl font-extralight leading-loose tracking-[.2em] uppercase">
                    Sara
                    Sperandio<br>laboratori e
                    psicologia</p>

                <div class="slider__mobile-contacts flex justify-center gap-6 lg:hidden">
                    @foreach (config('custom.social_media') as $contactSlug => $contact)
                        <a href="{{ $contact['url'] }}"
                            class="slider__contact w-6 aspect-square flex justify-center hover:text-primary transition-colors"
                            target="_blank">
                            {{ import_svg('icons/contacts/' . $contactSlug) }}
                        </a>
                    @endforeach
                </div>
            </div>

            <x-form.button href="#bio">Esplora</x-form.button>
        </div>

        {{-- Scroller --}}
        <aside class="slider__scroller hidden lg:block">
            <a href="#bio" class="grid gap-8 justify-items-center">
                <div class="slider-bar slider-bar--hidden"></div>
                <p class="slider__explore uppercase text-lg font-heading font-light tracking-[.2em]">esplora</p>
                <div class="slider-bar"></div>
            </a>
        </aside>
    </div>
</div>
