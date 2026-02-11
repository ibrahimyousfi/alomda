# Troubleshooting Guide - cPanel Hosting Issues

## Common Problems and Solutions

### 1. White Screen / 500 Error
**Causes:**
- Missing `.env` file
- Wrong file permissions
- PHP version mismatch
- Missing vendor folder

**Solutions:**
```bash
# Check PHP version (should be 8.2+)
php -v

# Create .env file
cp .env.example .env

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 644 .env

# Install dependencies
composer install --no-dev --optimize-autoloader
```

### 2. 404 Not Found
**Causes:**
- Document Root not pointing to `public`
- `.htaccess` not working
- mod_rewrite not enabled

**Solutions:**
- In cPanel, set Document Root to `public` folder
- Or ensure `.htaccess` in root exists and redirects to `public`
- Contact hosting to enable mod_rewrite

### 3. Database Connection Error
**Causes:**
- Wrong database credentials in `.env`
- Database host should be `localhost` (not `127.0.0.1`)

**Solutions:**
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Assets Not Loading (CSS/JS)
**Causes:**
- Missing `public/build` folder
- Assets not built

**Solutions:**
```bash
npm install
npm run build
```

### 5. Storage Link Error
**Causes:**
- Symbolic link not created

**Solutions:**
```bash
php artisan storage:link
```

## Quick Fix Checklist

1. ✅ Upload all files to server
2. ✅ Create `.env` file from `.env.example`
3. ✅ Update database credentials in `.env`
4. ✅ Set `APP_URL` to your domain
5. ✅ Run `composer install --no-dev`
6. ✅ Run `npm install && npm run build`
7. ✅ Run `php artisan key:generate`
8. ✅ Run `php artisan migrate --force`
9. ✅ Run `php artisan storage:link`
10. ✅ Set permissions: `chmod -R 755 storage bootstrap/cache`
11. ✅ Set Document Root to `public` folder in cPanel
12. ✅ Clear cache: `php artisan config:clear && php artisan cache:clear`

## Check Logs
```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# Check PHP error log in cPanel
# cPanel → Errors → Error Log
```
