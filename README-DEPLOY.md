# دليل النشر على cPanel - ALOMDA

## المتطلبات الأساسية
- PHP 8.2 أو أحدث
- Composer
- MySQL 5.7+ أو MariaDB 10.3+
- Node.js و NPM
- mod_rewrite مفعّل في Apache

## خطوات النشر السريع

### 1. رفع الملفات
ارفع جميع ملفات المشروع إلى المجلد الرئيسي (public_html أو المجلد المخصص)

### 2. إعداد قاعدة البيانات
1. من cPanel → MySQL Databases
2. أنشئ قاعدة بيانات جديدة
3. أنشئ مستخدم قاعدة بيانات
4. اربط المستخدم بالقاعدة وامنحه جميع الصلاحيات

### 3. إعداد ملف .env
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

### 4. تشغيل الأوامر (Terminal في cPanel)
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

### 5. إعدادات cPanel
- **Document Root**: يجب أن يشير إلى مجلد `public`
- أو استخدم `.htaccess` في الجذر (موجود بالفعل)

## ملفات .htaccess
- `.htaccess` في الجذر: يوجّه الطلبات إلى `public`
- `public/.htaccess`: إعدادات Laravel والأمان

## ملاحظات مهمة
- تأكد من `APP_DEBUG=false` في الإنتاج
- فعّل SSL/HTTPS
- احفظ نسخة احتياطية من قاعدة البيانات
- راجع صلاحيات المجلدات (storage, bootstrap/cache)
