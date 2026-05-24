# ActivityTracker

A Laravel web application for managing team activities and daily handovers.

## Requirements

- PHP 8.4+
- Composer
- PostgreSQL database

## Setup Instructions

1. Clone the repository
   git clone https://github.com/Skuet/activity-tracker.git
   cd activity-tracker

2. Install dependencies
   composer install

3. Copy environment file
   copy .env.example .env

4. Update `.env` with your database credentials
   DB_CONNECTION=pgsql
   DB_HOST=your_host
   DB_PORT=5432
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

5. Generate app key
   php artisan key:generate

6. Run migrations
   php artisan migrate

7. Start the server
   php artisan serve

8. Visit http://127.0.0.1:8000

## Features

- User registration, login and password reset
- Daily handover tracking
- Activity management with logs
- Reports module

