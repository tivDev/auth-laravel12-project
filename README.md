# Laravel Sanctum Authentication Setup (Laravel 12)

This guide provides step-by-step instructions to set up Laravel Sanctum for API authentication in your Laravel 12 project.

---

## Step 1: Set Up the Project

Before proceeding, ensure your Laravel 12 project is set up. If you are starting fresh, run the following commands:

```bash
composer install
php artisan key:generate
```

> **Note:** If you are adding Sanctum to an existing project, ensure your dependencies are up-to-date by running `composer update`.

---

## Step 2: Configure the `.env` File

Set up your `.env` file with the correct database credentials and other necessary configurations. For example:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

> **Tip:** Ensure the database exists before running migrations.

---

## Step 3: Install Sanctum

Install Sanctum via Composer by running the following command:

```bash
composer require laravel/sanctum
```

---

## Step 4: Publish Sanctum Configuration

Publish the Sanctum configuration and migration files using the command below:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## Step 5: Run Sanctum Migrations

Run the migrations to create the necessary database tables for Sanctum:

```bash
php artisan migrate
```

---

## Example API Route

You can test your API setup using the following example route:

```
http://127.0.0.1:8000/api/ping2
```

---

## Additional Notes

- Ensure you have configured your `.env` file with the correct database credentials before running migrations.
- This guide is specifically tailored for Laravel version 12.
- Refer to the [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum) for advanced usage and configuration options.