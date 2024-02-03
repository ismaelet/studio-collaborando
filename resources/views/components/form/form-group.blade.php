@pushOnce('styles')
    <style>
        .form-group {
            grid-template-columns: minmax(0, 1fr);

            &:has([data-size]) {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            & :not([data-size]) {
                grid-column: span 4;
            }

            & [data-size="2"] {
                grid-column: span 2;
            }
        }
    </style>
@endpushOnce

<div class="form-group grid gap-4">
    {{ $slot }}
</div>
