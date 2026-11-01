# Studio Collaborando

Official website for **Studio Collaborando**, built with Laravel, Inertia.js, Svelte, and Tailwind CSS.

The project provides a modern, responsive web experience, combining Laravel's backend capabilities with Svelte's component-based frontend architecture.

## Technology Stack

### Backend
- **PHP** — Server-side programming language.
- **Laravel** — Application framework, routing, validation, and backend logic.
- **MySQL / MariaDB** — Relational database.
- **Filament** — Administration panel and content management.

### Frontend
- **Svelte** — Reactive user interface components.
- **Inertia.js** — Integration between Laravel and the frontend without a separate REST API.
- **TypeScript** — Type-safe frontend development.
- **Tailwind CSS 4** — Utility-first styling and design system.
- **Vite** — Frontend development server and asset bundling.

### Development Tools
- **Composer** — PHP dependency management.
- **pnpm** — JavaScript package management.
- **Docker** — Containerized development environment.
- **Git** — Version control.

## Project Structure

The Laravel application is located in the `app/` directory.

```text
studio-collaborando/
├── app/
│   ├── app/                 # Laravel application logic
│   ├── bootstrap/           # Laravel bootstrap
│   ├── config/              # Application configuration
│   ├── database/            # Migrations and database files
│   ├── public/              # Public entry point and assets
│   ├── resources/
│   │   ├── css/             # Stylesheets and design tokens
│   │   ├── js/              # Svelte components and TypeScript
│   │   └── views/           # Blade templates
│   ├── routes/              # Application routes
│   └── tests/               # Automated tests
├── docker-compose.yml       # Container configuration
└── README.md
```

## Local Development

### Requirements

- PHP and Composer
- Node.js and pnpm
- MySQL or MariaDB
- Docker and Docker Compose (for containerized development)

### Installation

Clone the repository and enter the Laravel application directory.

```bash
git clone <repository-url>
cd studio-collaborando/app
```

Install the backend and frontend dependencies:

```bash
composer install
pnpm install
```

Create a local environment configuration:

```bash
cp .env.example .env
php artisan key:generate
```

Configure the database connection in `.env`, then run the migrations:

```bash
php artisan migrate
```

### Development Server

Start the Laravel application:

```bash
php artisan serve
```

In another terminal, start the Vite development server:

```bash
pnpm dev
```

## Production Build

Compile and optimize frontend assets:

```bash
pnpm build
```

The compiled assets are generated in Laravel's public build directory.

## Code Quality

The project uses automated formatting and linting tools to maintain consistent code quality.

Run the scripts defined in `package.json`:

```bash
pnpm format
pnpm lint
```

Run Laravel tests:

```bash
php artisan test
```

## Architecture

The application follows a server-driven architecture using **Laravel and Inertia.js**.

Laravel handles routing, data access, validation, and server-side operations, while Inertia.js passes page data to the Svelte frontend.

Svelte components handle interactive user interfaces, and Tailwind CSS provides consistent styling across the website.

## Security

Environment configurations, credentials, database backups, and local development resources are excluded from version control.

Sensitive configuration must be supplied through environment variables and should never be committed to the repository.

## License

All rights reserved. This project is not licensed for redistribution or reuse without permission.