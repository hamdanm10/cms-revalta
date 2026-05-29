# CMS Revalta

A content management system built with **Laravel 12**, **Tailwind CSS v4**, **Alpine.js**, and **Blade** components. Designed to manage blogs, portfolios, and job openings with a clean admin interface and a public REST API.

## Tech Stack

- **Laravel 12** — Backend framework
- **Tailwind CSS v4** — Utility-first CSS (configured entirely in CSS, no `tailwind.config.js`)
- **Alpine.js** — Lightweight frontend reactivity
- **Vite** — Frontend build tool with HMR
- **Pest** — Testing framework
- **SQLite** (default) / MySQL

## Features

### Admin Panel
- **Dashboard** — Overview stats for blogs, portfolios, and job openings
- **Blogs** — Full CRUD with category, thumbnail, rich-text content (Quill editor), status (published/draft), and view tracking
- **Blog Categories** — Full CRUD
- **Portfolios** — Full CRUD with category, thumbnail, and status
- **Portfolio Categories** — Full CRUD
- **Job Openings** — Full CRUD with work type (remote/wfa/wfo/hybrid) and status (open/closed)
- **API Documentation** — Built-in page documenting all REST API endpoints
- **Dark Mode** — Persistent dark/light theme via Alpine.js store

### REST API
All endpoints require the following headers:
```
Accept: application/json
X-API-Token: <your-api-token>
```

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/api/registrations` | Register a new user |
| `GET` | `/api/job-openings` | List published job openings (paginated) |
| `GET` | `/api/portfolios` | List published portfolios (paginated) |
| `GET` | `/api/blogs` | List published blogs (paginated, excludes content) |
| `GET` | `/api/blogs/{slug}` | Get a single blog by slug (includes content) |
| `POST` | `/api/blogs/{slug}/views` | Increment view count for a blog |

## Requirements

- PHP 8.3+
- Composer
- Node.js 18+ & npm
- Database: SQLite (default), MySQL, or PostgreSQL

## Installation

### 1. Install dependencies

```bash
composer install
npm install
```

### 2. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure the following in `.env`:

```env
APP_URL=http://localhost:8000

# Database (SQLite default, no changes needed)
# For MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=cms_revalta
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# API token for REST API authentication
API_TOKEN=your-secure-token-here
```

### 3. Run migrations

```bash
php artisan migrate
```

### 4. Create storage symlink

```bash
php artisan storage:link
```

## Running the Application

### Development

```bash
composer run dev
```

Starts Laravel server, Vite dev server, queue worker, and log monitor concurrently.

### Production

```bash
npm run build
php artisan optimize
```

## Available Commands

```bash
# Start development environment
composer run dev

# Run tests
composer run test

# Format PHP code
vendor/bin/pint

# Clear all caches
php artisan optimize:clear
```

## Project Structure

```
cms-revalta/
├── app/
│   ├── Helpers/              # MenuHelper — sidebar navigation source of truth
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Admin panel controllers
│   │   │   ├── Api/          # REST API controllers
│   │   │   └── Auth/         # Login/logout controllers
│   │   ├── Middleware/       # ValidateApiToken
│   │   └── Requests/
│   │       ├── Admin/        # Admin form requests
│   │       └── Api/          # API form requests
│   ├── Models/               # Blog, Portfolio, JobOpening, etc.
│   ├── Repositories/         # Database query logic
│   ├── Services/             # Business logic (Admin & Auth)
│   └── View/Components/      # Blade component PHP classes
├── bootstrap/
│   └── app.php               # Middleware & routing configuration
├── config/
│   └── app.php               # Includes api_token config key
├── resources/
│   ├── css/app.css           # Tailwind v4 config via @theme directive
│   ├── js/app.js             # Alpine.js, ApexCharts, flatpickr setup
│   └── views/
│       ├── components/       # Blade component templates
│       │   └── admin/        # Admin-specific components
│       ├── layouts/app.blade.php
│       └── pages/            # Page views (extend layouts.app)
├── routes/
│   ├── api.php               # Public REST API routes
│   └── web.php               # Web & admin routes
└── tests/
    ├── Feature/
    └── Unit/
```

## Architecture Notes

- **Repositories** handle all database queries and are injected into controllers and services.
- **Services** handle business logic (file uploads, model creation/update) and are injected into controllers.
- **Controllers** are kept thin — they validate input, call a service or repository, and return a response.
- **Blade Components** follow a two-file pattern: a PHP class in `app/View/Components/` and a template in `resources/views/components/`.
- **Sidebar menu** is managed entirely through `app/Helpers/MenuHelper.php`.
- **API routes** live in `routes/api.php` and use the `api` middleware group (stateless, no CSRF, throttled).

## Testing

```bash
# Run all tests
composer run test

# Run a specific test
php artisan test --filter=TestClassName
```

Tests use Pest and run against an in-memory SQLite database.

## License

Private project. All rights reserved.
