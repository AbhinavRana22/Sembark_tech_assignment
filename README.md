# Sembark URL Shortener

A Laravel-based URL shortener application with role-based access control (RBAC) using Spatie Permission package.

## Features

- Role-based authentication (Super Admin, Admin, Member)
- Company management
- User invitation system with email verification
- Short URL creation and tracking
- Click analytics for shortened URLs

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL
- Laravel 12

## Installation Steps

### 1. Clone the repository

```bash
git clone <repository-url>
cd Sembark_tech_assignment
```

### 2. Install dependencies

```bash
composer install
```
### 3. Install npm dependencies
```bash
npm install
```

### 4. Environment setup

Copy the example environment file:

```bash
cp .env.example .env
```

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sembark_tech_assignment
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Seed the database (Roles & Super Admin)

```bash
php artisan db:seed
```

This will create:
- Roles: Super Admin, Admin, Member
- Super Admin user account

### 8. Configure mail settings (Optional - for email invitations)

Update your `.env` file with SMTP settings:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
```

For testing, you can use:
```env
MAIL_MAILER=log
```
This will log emails to `storage/logs/laravel.log` instead of sending them.

### 9. Clear configuration cache

```bash
php artisan config:clear
php artisan cache:clear
```

### 10. Start the development server

```bash
php artisan serve
```

The application will be available at: `http://127.0.0.1:8000`

## Super Admin Credentials

After running the seeder, you can login with:

- **Email:** `superadmin@sembark.com`
- **Password:** `sembark12345`

## User Roles & Permissions

### Super Admin
- Create and manage companies
- View all short URLs across all companies
- Cannot create short URLs

### Admin
- Create and manage short URLs for their company
- Invite users (Admin/Member) to their company
- View short URLs within their company

### Member
- Create short URLs
- View only their own short URLs

## Project Structure

- `app/Http/Controllers/` - Application controllers
- `app/Models/` - Eloquent models
- `database/migrations/` - Database migrations
- `database/seeders/` - Database seeders
- `resources/views/` - Blade templates
- `routes/web.php` - Web routes

## Technologies Used

- Laravel 12
- Spatie Permission Package (RBAC)
- MySQL
- Blade Templates
- PHP 8.2+
- Bootstrap 5
- jQuery

## Usage

1. Login as Super Admin
2. Create a company (this will automatically create an Admin user for that company)
3. Admin can invite more users (Admin/Member) to their company
4. Admin/Member users can create short URLs
5. Track clicks on shortened URLs