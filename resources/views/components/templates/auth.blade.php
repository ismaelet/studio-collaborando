@push('styles')
    <style>
        .welcome {
            height: 30vh;
        }

        @media (min-width: 769px) {
            .page__content {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .welcome {
                height: 100%;
            }
        }
    </style>
@endpush

<x-templates.default :header-config="['floating' => true]">
    <div class="page__content grid-flow full-width justify-items-center">
        <section class="welcome fill-all">
            {{ $welcome }}
        </section>

        <form method="POST" class="grid-flow center-content fill-width max-width--480 pi-2 pb-4" data-spacing="800">
            <div>
                <h1 class="title title--register fa-center">{{ $title }}</h1>
            </div>

            <div class="grid-flow" data-spacing="400">
                @csrf

                {{ $body }}
            </div>

            <div class="grid-flow" data-spacing="400">
                {{ $footer }}
            </div>
        </form>
    </div>
</x-templates.default>
