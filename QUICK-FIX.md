# Quick Fix for cPanel Hosting

## Step-by-Step Fix

### 1. Upload Files
Upload ALL files to your hosting (including hidden files like `.htaccess`, `.env.example`)

### 2. Create .env File
In cPanel File Manager or via SSH:
```bash
cp .env.example .env
```

Then edit `.env` and set:
```env
APP_NAME="ALOMDA"
APP_ENV=production
APP_DEBUG=true
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Run Commands (cPanel Terminal)
```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install Node dependencies and build
npm install
npm run build

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 4. Set Document Root
In cPanel:
- Go to **Domains** → **Your Domain**
- Set **Document Root** to: `public_html/public` (or your folder path + `/public`)

OR if you can't change Document Root, the `.htaccess` in root will redirect to `public`

### 5. Test
Visit: `https://yourdomain.com/index-check.php` to verify setup

### 6. Common Issues

**If you see 500 Error:**
- Check error log in cPanel
- Set `APP_DEBUG=true` temporarily in `.env`
- Check file permissions

**If assets don't load:**
- Run `npm run build` again
- Check `public/build` folder exists

**If database error:**
- Verify database credentials in `.env`
- Use `localhost` not `127.0.0.1` for DB_HOST
