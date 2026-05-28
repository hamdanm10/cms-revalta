# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Development (starts Laravel server, Vite, queue worker, and log monitor concurrently)
composer run dev

# Run tests (clears config first, then runs Pest)
composer run test

# Run a single test
php artisan test --filter=TestClassName

# Build frontend assets for production
npm run build

# Format PHP code
vendor/bin/pint

# Clear all caches
php artisan optimize:clear
```

## Architecture

This is a **Laravel 12 admin dashboard** built on the [TailAdmin](https://tailadmin.com/laravel) template. The stack is Laravel + Blade + Alpine.js + Tailwind CSS v4 + Vite.

### Blade Component System

Every reusable UI piece follows a two-file pattern:
- **PHP class**: `app/View/Components/{category}/{Name}.php` — passes data to the view
- **Blade template**: `resources/views/components/{category}/{name}.blade.php` — the markup

Components are grouped by category: `common/`, `ecommerce/`, `form/`, `header/`, `profile/`, `tables/`, `ui/`. Pages live in `resources/views/pages/` and extend `layouts.app` via `@extends` / `@yield('content')`.

### Sidebar Navigation

`app/Helpers/MenuHelper.php` is the **single source of truth** for sidebar menu structure and icons. All menu groups, items, sub-items, and their SVG icons are defined here. To add a new page to the sidebar, add an entry in `getMainNavItems()` or `getOthersItems()`, then add the corresponding route in `routes/web.php` and create the Blade view.

### Alpine.js Global Stores

Two persistent Alpine stores are initialized in `resources/views/layouts/app.blade.php`:
- `$store.theme` — dark/light mode, persisted to `localStorage`
- `$store.sidebar` — expanded/collapsed/mobile/hover states, driven by viewport width (≥1280px = desktop expanded)

These stores are read throughout Blade templates using `:class` bindings and `x-show` directives.

### Tailwind CSS v4 Configuration

Tailwind is configured **entirely in CSS** via `resources/css/app.css` using the `@theme` directive — there is no `tailwind.config.js`. Custom design tokens (brand colors, breakpoints, shadows, z-index scale) and custom utilities (sidebar menu classes like `.menu-item`, `.menu-item-active`) are all defined here with `@utility`. Dark mode uses `@custom-variant dark (&:is(.dark *))`, toggled by adding the `dark` class to `<html>`.

### JavaScript

`resources/js/app.js` registers Alpine, ApexCharts, flatpickr, and FullCalendar as globals, then **lazy-loads** chart and map components by checking for DOM element presence (`#chartOne`, `#mapOne`, etc.). Individual chart modules live in `resources/js/components/chart/`. Adding a new chart requires: creating the module file, adding a DOM-presence check in `app.js`, and referencing the element ID in the Blade template.

### Testing

Tests use **Pest** and run against an in-memory SQLite database (configured in `phpunit.xml`). Feature tests in `tests/Feature/`, unit tests in `tests/Unit/`.

### Deployment Environment

The `.lerd.yaml` declares this app targets a `cms-revalta` domain with PHP 8.3, Laravel 12, and MySQL. Local development defaults to SQLite unless `.env` overrides `DB_CONNECTION`.
