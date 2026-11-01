# Studio Collaborando

Laravel 13 with Inertia 2, Svelte 5, Tailwind CSS 4, and Vite.

Run repository-level Docker Compose commands from this directory. The Laravel application and frontend package live in `app/`.

```sh
cd app
pnpm dev
pnpm build
pnpm check
pnpm lint
```

With the existing containers, use `docker compose exec vite pnpm build` and `docker compose exec vite pnpm check` from the repository root.

## Frontend

`app/resources/js/app.ts` boots Inertia and resolves Svelte pages in `resources/js/Pages/`. The only Blade template used to render the migrated web UI is `resources/views/app.blade.php`, Inertia's HTML document shell. Email templates remain Blade because they render on the server for mail clients.

The public routes (`/`, `/home`, `/services`, `/pet-therapy`, `/courses`, `/contacts`, `/privacy`) render `Home.svelte`, preserving their previous shared homepage behavior. Authentication routes render the pages under `Pages/Auth/`; profile routes use `Pages/UserDashboard/`; admin routes use `Pages/Admin/`. Not-found and maintenance responses use `Error.svelte`.

Shared Svelte layouts and components replace the route-used Blade layouts, navigation, footer, buttons, inputs, forms, panels, tables, pagination, newsletter bar, homepage slider, and dashboard widgets. The former Livewire newsletter interaction is handled by `POST /newsletter`. Forms use Inertia's form store, with Laravel validation and redirects. Course access, file discovery, and dashboard queries run in controllers. `HandleInertiaRequests` shares public site configuration, safe user fields, and flash messages.

Legacy Blade templates and the old Livewire class remain in the repository as unused migration references; the migrated routes do not render them. Legacy controllers not referenced in the route files have not been migrated. The existing `POST /admin/dashboard` route still references an unimplemented `update` action; there is no corresponding submitting control in the migrated dashboard.

## Validation

```sh
docker compose exec -e APP_ENV=testing app php artisan test --filter=InertiaMigrationTest
docker compose exec vite pnpm check
docker compose exec vite pnpm build
```

Migration tests create isolated SQLite in-memory tables; they do not modify the running application's database. They cover public and authenticated Inertia responses, validation, registration, login/logout, password recovery/reset, profile/password updates, course access, newsletter subscriptions, admin resource actions, dashboard props, and error responses.
