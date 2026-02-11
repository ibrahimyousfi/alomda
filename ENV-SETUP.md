# .env File Setup for Production

## Required Changes in .env File

After opening `.env` with `nano .env`, update these values:

### 1. Application Settings
```env
APP_NAME="ALOMDA"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://alomdatools.ma
```

### 2. Database Settings
Replace with your actual database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 3. Application Key
The key will be generated automatically when you run:
```bash
php artisan key:generate
```

## Complete .env Template

Copy this entire content to your `.env` file:

```env
APP_NAME="ALOMDA"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://alomdatools.ma

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="contact@alomdatools.ma"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## How to Edit in Nano

1. Open file: `nano .env`
2. Use arrow keys to navigate
3. Edit the values
4. Save: `Ctrl + X`
5. Confirm: `Y`
6. Enter to confirm filename

## Important Notes

- **DO NOT** set `APP_DEBUG=true` in production
- **DO NOT** commit `.env` file to Git
- Replace `your_database_name`, `your_database_user`, `your_database_password` with actual values
- The `APP_KEY` will be generated automatically by `php artisan key:generate`
