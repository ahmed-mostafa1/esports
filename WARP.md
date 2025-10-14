# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Common Development Commands

### Setup & Installation
```bash
# Initial project setup (runs migrations, installs dependencies, builds assets)
composer setup

# Development environment with all services running
composer dev
```

The `composer dev` command starts multiple concurrent services:
- Laravel development server (`php artisan serve`)
- Queue worker (`php artisan queue:listen --tries=1`)  
- Laravel Pail for log monitoring (`php artisan pail --timeout=0`)
- Vite asset compilation with hot reloading (`npm run dev`)

### Testing
```bash
# Run all tests (clears config cache first)
composer test

# Run tests with PHPUnit directly
./vendor/bin/phpunit

# Run specific test file
./vendor/bin/phpunit tests/Feature/ExampleTest.php

# Run Pest tests (alternative test runner)
./vendor/bin/pest
```

### Asset Development
```bash
# Development build with hot reloading
npm run dev

# Production build
npm run build
```

### Laravel Artisan Commands
```bash
# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Clear various caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Code style formatting (Laravel Pint)
./vendor/bin/pint
```

## Application Architecture

### Content Management System
This is a bilingual (English/Arabic) esports website with a custom CMS built around a flexible content model:

**Key Design Patterns:**
- **Content Key Scheme**: `page.section.item` (e.g., `home.hero.title`, `about.header.subtitle`)
- **Bilingual Content**: Uses Spatie Translatable package with JSON storage for multi-language support
- **Shared Images**: Images are language-agnostic with filenames matching content keys
- **Session-based Locales**: Language switching via session, no URL prefixes

### Core Models

**Content Model** (`app/Models/Content.php`):
- Primary CMS model handling both text and image content
- Uses `Spatie\Translatable\HasTranslations` for bilingual text content
- Fields: `key` (unique), `type` (text/image), `group` (page name), `value` (JSON)
- Text values: `{"en": "English text", "ar": "Arabic text"}`  
- Image values: `{"path": "home.hero.png"}`

**User Model** (`app/Models/User.php`):
- Standard Laravel authentication model
- Enhanced with Laravel Breeze for auth scaffolding

### Helper Functions

**Content Retrieval** (`app/Support/helpers.php`):
- `content($key, $default)`: Get translated text with locale fallback (current → en → default)
- `content_media($key, $default)`: Get image URLs with smart fallback handling

### Database Schema

**Contents Table**:
- `key`: Unique content identifier (e.g., "home.hero.title")
- `type`: "text" or "image"  
- `group`: Page grouping (e.g., "home", "about", "partners")
- `value`: JSON field storing either translations or image paths
- Indexed on `group` and `type` for admin filtering

### Frontend Structure

**Site Pages** (`resources/views/site/`):
- Complete esports website with pages: home, about, gallery, news, partners, services, tournaments, etc.
- Bilingual support with Arabic RTL capabilities
- User registration for single players and teams

**Routing Pattern** (`routes/web.php`):
- Simple route-to-view mapping for most pages
- Locale switching via `/lang/{locale}` route
- Authentication routes for user dashboard and registration features

### Asset Pipeline

**Vite Configuration**:
- Modern asset bundling with Vite
- Tailwind CSS for styling with forms plugin
- Alpine.js for JavaScript interactivity  
- Auto-refresh during development

**Frontend Stack**:
- **CSS**: Tailwind CSS v3.1 with forms plugin
- **JavaScript**: Alpine.js v3.4 for reactive components
- **Bundler**: Vite v7 with Laravel plugin
- **HTTP Client**: Axios for API requests

## Development Workflow

### Content Management
The application follows a content-key architecture where:

1. **Content Keys** are defined by developers in `page.section.item` format
2. **Content Values** are managed through the CMS (admin area planned but not yet implemented)
3. **Fallback Logic** ensures graceful degradation: Arabic → English → default value
4. **Image Management** uses shared files with predictable naming based on content keys

### Localization Strategy
- **Primary Language**: English (fallback)
- **Secondary Language**: Arabic (RTL support)
- **Storage**: JSON columns with Spatie Translatable
- **Switching**: Session-based via dedicated route handler
- **HTML Direction**: Automatic `dir` attribute based on locale

### Testing Setup
- **Framework**: Laravel with Pest PHP as primary test runner
- **Database**: SQLite in-memory for testing
- **Environment**: Separate testing configuration in `phpunit.xml`
- **Coverage**: Tests focus on Unit and Feature test suites

## Project Context

This is an esports tournament platform with comprehensive features for:
- Tournament information and registration
- Team and individual player registration  
- News and updates
- Partner/sponsor management
- Gallery and media content
- User authentication and profiles

The architecture supports future admin panel development following the detailed plan outlined in `plan.txt`, including content editing interfaces, page skeleton editors, and advanced CMS features.

## File Structure Notes

- **Models**: Minimal, focused on Content and User entities
- **Views**: Organized by purpose (site/, auth/, layouts/, components/)
- **Routes**: Clean, mostly static route-to-view mappings
- **Assets**: Standard Laravel + Vite structure in `resources/`
- **Database**: Simple migration structure focused on content management