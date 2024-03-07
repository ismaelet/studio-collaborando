@pushOnce('styles')
    <style>
        .newsletter-bar {
            background-color: #ebebeb;

            >div {
                grid-column: full-width;
            }
        }

        .newsletter-bar__background::after {
            content: '';
            background: linear-gradient(hsl(0, 0%, 92%, 1), hsl(0, 0%, 92%, 0));
        }

        .newsletter-bar__form {
            display: flex;
            justify-content: center;

            .newsletter-bar__input {
                width: min(15rem, 50vw);
                border-top-left-radius: 100vw;
                border-bottom-left-radius: 100vw;
                text-align: center;
            }

            .newsletter-bar__button {
                min-width: unset;
                padding-inline: 1.5em 2em;
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }
        }
    </style>
@endpushOnce

<section class="newsletter-bar full-width">
    <div class="grid stack-content">
        <div class="newsletter-bar__background grid opacity-20"
            style="{{ set_background_image('components/newsletter-background.webp') }}">
        </div>

        <div class="newsletter-bar__content py-16 text-center grid gap-4 relative">
            <x-typography.section-heading>Iscriviti alla newsletter</x-typography.section-heading>
            <p>Per essere sempre aggiornato e ricevere risorse gratuite per voi e i vostri bambini</p>

            @if (!$processing)
                <div class="newsletter-bar__form">
                    <x-form.input wire:model="email" type="email" class="newsletter-bar__input" name="email"
                        placeholder="Indirizzo e-mail" />
                    <x-form.button wire:click="subscribe" class="newsletter-bar__button">Iscriviti</x-form.button>
                </div>
            @endif

            @error('email')
                <p class="text-error font-semibold">{{ __($message) }}</p>
            @enderror

            @if ($success)
                <p class="text-success font-semibold">Iscrizione effettuata con successo</p>
            @endif
        </div>
    </div>
</section>
