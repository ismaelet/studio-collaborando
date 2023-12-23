@php
    $profileLocation = 'recap';

    //navigation menu
    $profileLinks = [['title' => 'Account', 'url' => 'user-dashboard.recap', 'location' => 'recap', 'icon' => 'user'], ['title' => 'I miei corsi', 'url' => 'user-dashboard.courses', 'location' => 'orders', 'icon' => 'orders'], ['title' => 'I miei dati', 'url' => 'user-dashboard.personal-data', 'location' => 'data', 'icon' => 'settings'], ['title' => 'Logout', 'url' => 'logout', 'location' => 'logout', 'icon' => 'logout']];

@endphp

@push('styles')
    <style>
        :root {
            --wrap-width: 1440px;
        }

        .page-body {
            display: grid;
            padding-block: 5rem 4rem;
            grid-template-columns: 18rem auto;
            align-items: flex-start;
            grid-gap: 3rem;
        }

        .page-content {
            display: grid;
            gap: 3rem;
            grid-template-columns: minmax(0, 1fr);
        }

        .page-block {
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .article-title {
            display: flex;
            align-items: center;
            gap: 0.5em;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .article-title .text-icon {
            width: 1.1em;
            height: 1.1em;
            color: var(--color-primary-400);
        }

        .section-subtitle {
            margin-bottom: 0.5rem;
        }

        .profile-nav {
            background-color: var(--surface-fade);
            border-radius: 1rem;
            overflow: hidden;
        }

        .profile-nav_header {
            display: none;
        }

        .profile-nav-title {
            padding: 1rem;
            background-color: var(--surface);
            font-size: 1.2rem;
            text-transform: uppercase;
        }

        .profile-nav-link p {
            padding-inline: 1rem 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            line-height: 4.5;
            transition: opacity 0.3s, height 0.3s, line-height 0.3s;
        }

        .profile-nav-link.active p {
            background-color: var(--color-primary-400);
            color: #fff;
        }

        .profile-nav-link.active .text-icon {
            background-color: #fff;
        }

        .orders-wrap {
            overflow-x: auto;
        }

        .order-list {
            display: grid;
            overflow: hidden;
            min-width: 768px;
            margin-top: 0.5rem;
            grid-template-columns: 1fr 3fr 1fr 1fr 2fr 1fr;
            border-radius: var(--border-radius);
        }

        .order {
            display: contents;
        }

        .order-field {
            display: grid;
            padding-block: 0.5rem;
            padding-right: 0.5rem;
            background-color: #f9f9f9;
            align-items: center;
        }

        .order-field:first-child {
            padding-left: 1rem;
        }

        .order:nth-child(2n) .order-field {
            background-color: #f1f1f1;
        }

        .order_header .order-field {
            background-color: var(--color-primary-400);
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .order-field_name {
            display: none;
            font-weight: 700;
        }

        .order-status {
            width: max-content;
            padding-inline: 1em;
            background-color: #ddd;
            border-radius: 1rem;
            /*font-weight: 600;*/
            color: var(--text-color-strong);
        }

        .order-status_canceled {
            background-color: #ff6f6f !important;
        }

        .order-status_waiting-payment {
            background-color: #bdf2ff !important;
        }

        .order-status_confirmed {
            background-color: #ffc677 !important;
        }

        .order-status_shipped {
            background-color: #ff9600 !important;
        }

        .order-status_delivered {
            background-color: #44c544 !important;
        }

        .order-link {
            max-width: max-content;
            padding-inline: 0.2em;
        }

        @media (max-width: 1024px) {
            .page-body {
                grid-template-columns: minmax(0, 1fr);
                gap: 2rem;
                padding-top: 2rem;
            }

            .profile-nav_header {
                display: block;
            }

            .profile-nav-link p {
                opacity: 0;
                height: 0;
                line-height: 0;
            }

            input:checked~.profile-nav-links .profile-nav-link p {
                opacity: 1;
                height: 4em;
                line-height: 4em;
            }
        }

        @media (max-width: 480px) {
            .page-block {
                padding-inline: 1rem;
            }

            .order-list {
                min-width: unset;
                grid-template-columns: 1fr;
            }

            .order.order_header {
                display: none;
            }

            .order {
                display: block;
                padding: 1rem;
                background-color: #f9f9f9;
                text-align: center;
            }

            .order:nth-child(2n) {
                background-color: #f1f1f1;
            }

            .order-field {
                display: block;
                background-color: unset !important;
                font-size: 1rem;
            }

            .order-field:first-child {
                padding-left: 0;
                font-size: 1.2rem;
            }

            .order-field_name {
                display: inline;
            }

            .order-status {
                padding-block: 0.25em;
            }

            .order-link {
                display: block;
                padding-inline: 1rem;
                margin-top: 1rem;
                margin-inline: auto;
                border: 1px solid var(--text-color);
                border-radius: 2rem;
                line-height: 2;
                font-weight: 600;
            }
        }
    </style>
@endpush

<x-templates.main>
    <div class="page-body main-wrap">

        <nav class="profile-nav">
            <input type="checkbox" class="hidden" id="profile-nav-cbx">

            <!-- Title -->
            <label class="profile-nav_header" for="profile-nav-cbx">
                <h3 class="profile-nav-title flex-line">
                    {{ import_svg('icons/list') }}
                    Profilo
                </h3>
            </label>

            <!-- Navigation menu -->
            <ul class="profile-nav-links">

                <?php foreach ($profileLinks as $profileLink) { ?>

                <li class="profile-nav-link <?= $profileLocation == $profileLink['location'] ? 'active' : '' ?>">
                    <a href="{{ route($profileLink['url']) }}">
                        <p class="flex-line">
                            {{ import_svg('icons/' . $profileLink['icon']) }}
                            <?= $profileLink['title'] ?>
                        </p>
                    </a>
                </li>

                <?php } ?>

            </ul>
        </nav>

        <div class="page-content">
            {{ $slot }}
        </div>

    </div>
</x-templates.main>
