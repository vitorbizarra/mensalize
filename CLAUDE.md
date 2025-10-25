# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application called "mensalize" that uses:
- **Livewire v3.6** for reactive components
- **Filament v4.1** for admin panel functionality
- **Tailwind CSS v4.1** for styling (via Vite plugin)
- **Pest v4** for testing (with Livewire plugin)

## Development Commands

### Setup & Installation
```bash
composer setup          # Full setup: install deps, .env, key, migrate, npm install & build
composer dev           # Start all services (server, queue, logs, vite) concurrently
```

### Testing
```bash
composer test          # Clear config cache and run full test suite
php artisan test       # Run all Pest tests
php artisan test --filter=CounterTest  # Run specific test file
```

### Asset Building
```bash
npm run dev           # Start Vite dev server with HMR
npm run build         # Build production assets
```

### Livewire Commands
```bash
php artisan make:livewire ComponentName    # Create new Livewire component
php artisan livewire:layout                # Generate layout file
php artisan livewire:publish --config      # Publish Livewire config
```

### Filament Commands
```bash
php artisan make:filament-resource ModelName --generate  # Generate resource from model
php artisan make:filament-user                           # Create admin user interactively
php artisan filament:upgrade                             # Upgrade Filament assets (runs on composer update)
```

### Code Quality
```bash
./vendor/bin/pint      # Format code with Laravel Pint
```

## Architecture

### Livewire Configuration
- **Namespace**: `App\Livewire`
- **View Path**: `resources/views/livewire`
- **Default Layout**: `components.layouts.app` (at `resources/views/components/layouts/app.blade.php`)
- Components auto-inject assets and use Tailwind pagination theme

### Filament Admin Panel
- **Panel ID**: `admin`
- **URL Path**: `/admin` (login at `/admin/login`)
- **Panel Provider**: `App\Providers\Filament\AdminPanelProvider`
- **Resource Discovery**: Auto-discovers resources in `app/Filament/Resources`
- **Primary Color**: Amber
- **Resource Structure**: Filament v4 uses a separated schema approach:
  - Resources are in `app/Filament/Resources/{ModelName}/`
  - Each resource has separate classes for Forms (`Schemas/`), Tables (`Tables/`), and Pages (`Pages/`)
  - Example: `UserResource` has `UserForm.php`, `UsersTable.php`, and page classes

### Frontend Assets (Vite)
- **Entry Points**: `resources/css/app.css` and `resources/js/app.js`
- **Plugins**: Laravel Vite plugin + Tailwind CSS v4 Vite plugin
- Tailwind v4 uses `@import 'tailwindcss'` syntax (no separate config file)
- CSS sources configured via `@source` directives in `app.css`

### Testing with Pest
- Uses Pest v4 with Laravel and Livewire plugins
- Livewire component testing with `Livewire::test()` facade
- Feature tests in `tests/Feature/`
- Example: `CounterTest.php` shows Livewire component testing patterns

### Composer Scripts
- `composer dev` runs a concurrent setup with colored output for server, queue, logs, and Vite
- `composer test` automatically clears config cache before running tests
- Filament upgrade runs automatically on `composer update` via post-autoload-dump hook

## Project Conventions

### Git Commits
Use conventional commits with emoji prefixes:
- `:sparkles: feat:` - New features
- `:white_check_mark: test:` - Test additions
- `:lipstick: style:` - UI/styling changes
- `:package: build:` - Build system changes
- `:tada: init:` - Initial commits

Include attribution footer:
```
🤖 Generated with [Claude Code](https://claude.com/claude-code)

Co-Authored-By: Claude <noreply@anthropic.com>
```

### Filament Resources
When creating new Filament resources, use the separated schema pattern:
1. Create resource with `--generate` flag for auto-generation from model
2. Schemas go in `Schemas/` subdirectory (e.g., `UserForm.php`)
3. Tables go in `Tables/` subdirectory (e.g., `UsersTable.php`)
4. Pages go in `Pages/` subdirectory (e.g., `ListUsers.php`, `CreateUser.php`, `EditUser.php`)

### Livewire Components
- Store component classes in `app/Livewire/`
- Store views in `resources/views/livewire/`
- Use Tailwind classes for styling
- Test components using Pest with Livewire plugin assertions

## Database
- Default: SQLite (database file at `database/database.sqlite`)
- Migrations run automatically on setup via composer script
