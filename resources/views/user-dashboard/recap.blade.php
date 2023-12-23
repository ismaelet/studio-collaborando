@php
    $user = Auth::user();
@endphp

@push('styles')
    <style>
        .page-block {
            display: grid;
            gap: 3rem;
        }

        .page-block section {
            display: grid;
            gap: 1rem;
        }

        .show-more {
            width: max-content;
            padding-inline: 0.5em;
            margin-inline: auto;
            border-bottom: 1px solid;
        }

        .address {
            padding: 1.5rem;
            border: 1px solid var(--border-color-fade);
            border-radius: var(--border-radius);
        }

        .favorites {
            padding: 3rem;
            margin-block: -1rem -2rem;
            margin-inline: -3rem;
            overflow-x: auto;
            scroll-snap-type: inline mandatory;
        }

        .favorites-wrap {
            min-width: 768px;
        }

        .favorites .item-card {
            scroll-snap-align: start;
        }

        @media (max-width: 1024px) {
            .favorites {
                padding: unset;
                margin: unset;
                margin-top: 2rem;
            }
        }
    </style>
@endpush

<x-templates.user-dashboard>

    <div class="page-block">
        <!-- Personal data -->
        <section>
            <h3 class="article-title">
                {{ import_svg('icons/user') }}
                Account
            </h3>

            <div class="grid gap05">
                <h3 class="section-subtitle">I mei dati</h3>
                <?php if ($user->fullName()) { ?>
                <p><?= $user->fullName() ?></p>
                <?php } ?>
                <p><?= $user->email ?></p>
                <a href="{{ route('user-dashboard.personal-data') }}" class="sbtn sbtn_small">Modifica</a>
            </div>
        </section>
    </div>

</x-templates.user-dashboard>
