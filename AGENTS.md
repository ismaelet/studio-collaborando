# Project Instructions

## Stack and architecture

- Laravel, PHP 8.5, Inertia.js, Svelte, TypeScript, Tailwind CSS 4, and Vite.

## Project commands

- Repository root: the directory containing AGENTS.md and the Docker Compose configuration.
- Laravel root: app/. Run PHP, Artisan, Composer, and frontend commands from this directory.
- Run Docker Compose and repository-level Git commands from the repository root.
- Use the package manager specified by app/package.json and its lockfile.
- Prefer the project's existing scripts over invoking tools directly.

### PHP and Laravel

- PHP syntax: `cd app && php -l app/Http/Controllers/ExampleController.php`
- Targeted tests: `cd app && php artisan test --filter=TestName`
- PHP formatting check: `cd app && vendor/bin/pint --test`

### Frontend

- Frontend build: `cd app && pnpm run build`
- Formatting check: `cd app && pnpm run format:check`
- Apply formatting: `cd app && pnpm run format`
- Linting: `cd app && pnpm run lint`
- Use Oxfmt for supported frontend files and Oxlint for JavaScript/TypeScript linting.
- Use Laravel Pint for PHP formatting. Do not run Oxfmt or Oxlint on PHP files.

## Inertia and Svelte

- Pages: `app/resources/js/pages/`; components: `app/resources/js/components/`; layouts: `app/resources/js/layouts/`.
- Prefer Inertia for navigation and server-provided page data, and Svelte for interactive components.
- Keep database queries and business logic out of Svelte components.
- Reuse existing Svelte components before writing new markup, especially layouts, forms, buttons, typography, cards, and pagination.
- Use existing component APIs rather than duplicating markup, styling, or behavior.
- Avoid duplicating state between Inertia props and Svelte unless necessary.
- For links styled like buttons, reuse the existing button component rather than duplicating styles.
- For smaller buttons, use the button component's `size="sm"` prop.
- Don't place styling or size classes on icons inside button components.

## Validation

Run Docker commands from the repository root.

```bash
# Inspect recent logs
docker compose logs --tail=100 app

# Run targeted PHP tests
docker compose exec -e APP_ENV=testing app php artisan test --filter=TestName

# Run full PHP test suite when justified
docker compose exec -e APP_ENV=testing app php artisan test

# Build frontend assets
cd app && pnpm build
```

- Assume containers are already running. Do not restart, rebuild, or install dependencies unnecessarily.
- Always use `APP_ENV=testing` for PHP tests.
- Add or update tests for new behavior, bug fixes, or meaningful logic changes when existing coverage is insufficient.
- Prefer targeted tests before running the full suite.
- Styling, markup-only, and documentation changes do not require new tests.
- Run frontend builds only when relevant to modified assets or compilation behavior.
- Avoid repeated validation unless changes or failures justify it.
- Report validation failures or checks that could not be performed.

## Browser and visual testing

- For frontend styling and visual verification, follow the `frontend-design` skill.
- Minimize browser interactions and screenshot analysis unless necessary for correctness.

## Agent efficiency and scope

- Use targeted searches (`rg`, `rg --files`). Read relevant files only; expand investigation when necessary.
- Avoid repeated file reads, commands, repository-wide searches, and unrelated audits.
- Never generate images.

## Communication

- Be concise, technical, and action-oriented.
- After changes, briefly summarize what changed, validation performed, and any remaining issues.
