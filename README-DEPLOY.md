# cPanel Deployment Guide - ALOMDA

## Basic Requirements
- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js and NPM
- mod_rewrite enabled in Apache

## Quick Deployment Steps

### 1. Upload Files
Upload all project files to the main directory (public_html or designated folder)

### 2. Database Setup
1. From cPanel → MySQL Databases
2. Create a new database
3. Create a database user
4. Link the user to the database and grant all privileges

### 3. Configure .env File
```env
APP_NAME="ALOMDA"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Run Commands (Terminal in cPanel)
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 755 storage bootstrap/cache
```

### 5. cPanel Settings
- **Document Root**: Must point to the `public` folder
- Or use `.htaccess` in the root (already included)

## .htaccess Files
- `.htaccess` in root: Redirects requests to `public`
- `public/.htaccess`: Laravel settings and security

## Important Notes
- Make sure `APP_DEBUG=false` in production
- Enable SSL/HTTPS
- Regularly backup your database
- Review folder permissions (storage, bootstrap/cache)
