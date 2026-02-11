# Server Commands for cPanel

## Step-by-Step Commands to Run on Server

### 1. Navigate to Project Directory
```bash
cd /home/swissleg/alomdatools.ma
```

### 2. Create .env File
```bash
cp .env.example .env
```

### 3. Edit .env File
Use nano or vi to edit:
```bash
nano .env
```

Update these values:
```env
APP_NAME="ALOMDA"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://alomdatools.ma

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

Save and exit: `Ctrl+X`, then `Y`, then `Enter`

### 4. Install PHP Dependencies
```bash
composer install --no-dev --optimize-autoloader
```

### 5. Install Node Dependencies
```bash
npm install
```

### 6. Build Frontend Assets
```bash
npm run build
```

### 7. Generate Application Key
```bash
php artisan key:generate
```

### 8. Run Database Migrations
```bash
php artisan migrate --force
```

### 9. Create Storage Link
```bash
php artisan storage:link
```

### 10. Set Folder Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
```

### 11. Clear and Cache Configuration
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 12. Verify Setup
```bash
php artisan about
```

## Complete Command Sequence (Copy & Paste)
```bash
cd /home/swissleg/alomdatools.ma
cp .env.example .env
nano .env
# Edit .env file with your settings, then:
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan key:generate
php artisan migrate --force
php artisan storage:link
chmod -R 755 storage bootstrap/cache
chmod 644 .env
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Important Notes
- Project path: `/home/swissleg/alomdatools.ma`
- Domain: `alomdatools.ma`
- Replace database credentials with your actual values
- If `composer` command not found, use full path: `/usr/local/bin/composer`
- If `npm` command not found, use full path or install Node.js in cPanel
- **IMPORTANT**: Set Document Root in cPanel to `/home/swissleg/alomdatools.ma/public`
