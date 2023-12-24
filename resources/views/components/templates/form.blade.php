@push('styles')
    <style>
        main {
            --content-width: 480px;
        }

        .form__content {}
    </style>
@endpush

<x-templates.main>
    <form class="form__content grid content-center gap-8" action="" method="POST">
        @csrf

        <x-typography.section-heading class="text-center">{{ $title }}</x-typography.section-heading>

        <div class="form__body">
            {{ $body }}
        </div>

        <div class="form__footer grid gap-4">
            {{ $footer }}
        </div>
    </form>

</x-templates.main>
