# Laravel CMS Starter

A Laravel + Livewire starter template for building content-managed websites. The front end is driven by an editable CMS, and includes a contact form that persists submissions to the database.

## Features

- Projects and Blog posts are rendered dynamically through the CMS
- Contact form send messages directly to the database eliminating the need for external email providers.
- Blog posts can be saved as "Draft" or published through the CMS
- Categories and tags can be created and attached to each blog post
- User can upload pictures to amazon S3 buckets for their projects

## Tech Stack

| Layer       | Technology                           |
|-------------|--------------------------------------|
| Backend     | PHP 8.4, Laravel 13                  |
| Frontend    | Livewire 4, Flux UI                  |
| Auth        | Laravel Fortify                      |
| Storage     | S3 (via Flysystem)                   |

## Requirements

- PHP ^8.4
- Composer
- Node.js & npm
- PostgreSQL

## Getting Started

Clone the repo, then run the bundled setup script — it installs dependencies, creates your `.env`, generates the app key, runs migrations, and builds frontend assets:

```bash
composer setup
```

Or step by step:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Then start the dev environment (server, queue listener, and Vite, all at once):

```bash
composer dev
```

## Environment Variables

Configure your `.env` with at least:

```env
DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=
```
