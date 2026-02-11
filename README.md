# ALOMDA - Professional Jewelry Tools Store

A complete e-commerce platform built with Laravel for selling professional jewelry tools and equipment.

## Features
- **Admin Dashboard**: Complete management of products, categories, and orders
- **User Interface**: Attractive product display with bilingual support (Arabic and English)
- **Order System**: Direct ordering through the website
- **Design**: Fully responsive using Tailwind CSS

## Requirements
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL database (or SQLite for quick testing)

## Installation Steps

1. **Clone the project and install dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Environment Setup:**
   Copy `.env.example` to `.env` and configure database settings.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: The project is currently configured to work with SQLite for easy testing. To switch to MySQL, modify `DB_CONNECTION` in the `.env` file.*

3. **Build the database:**
   ```bash
   php artisan migrate --seed
   ```
   This will create tables and add:
   - Admin user (Email: `admin@alomda.com`, Password: `password`)
   - Sample products and categories.

4. **Build Frontend Assets:**
   ```bash
   npm run build
   ```

5. **Run Local Server:**
   ```bash
   php artisan serve
   ```
   You can now visit the site at: `http://localhost:8000`

## Admin Panel
To access the admin panel, go to: `http://localhost:8000/admin`
- **Email:** admin@alomda.com
- **Password:** password

## Database Structure
- **users**: Users and administrators table
- **categories**: Product categories (name in Arabic/English)
- **products**: Products (names, description, price, images)
- **orders**: Customer orders
- **order_items**: Products within each order

## Support
For any inquiries, please contact the development team.
