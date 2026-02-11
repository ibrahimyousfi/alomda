# cPanel Deployment Guide

## Hosting Requirements
- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js and NPM (for building)
- mod_rewrite enabled

## Deployment Steps

### 1. Upload Files
Upload all project files to the main directory (public_html or designated folder)

### 2. Database Setup
1. Create a new database from cPanel
2. Create a database user
3. Grant the user all privileges on the database

### 3. Configure .env File
1. Copy `.env.example` to `.env`
2. Update the following settings:
```env
APP_NAME="ALOMDA"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 5. Setup Laravel
```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Folder Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 7. cPanel Settings
- Make sure Document Root points to the `public` folder
- Or use `.htaccess` in the root to redirect requests to `public`

## Important Notes
- Make sure `APP_DEBUG=false` in production
- Enable SSL/HTTPS
- Review the `.htaccess` file to ensure it works correctly
- Regularly backup your database
