# دليل النشر على cPanel

## متطلبات الاستضافة
- PHP 8.2 أو أحدث
- Composer
- MySQL 5.7+ أو MariaDB 10.3+
- Node.js و NPM (للبناء)
- mod_rewrite مفعّل

## خطوات النشر

### 1. رفع الملفات
ارفع جميع ملفات المشروع إلى المجلد الرئيسي (public_html أو المجلد المخصص)

### 2. إعداد قاعدة البيانات
1. أنشئ قاعدة بيانات جديدة من cPanel
2. أنشئ مستخدم قاعدة بيانات
3. امنح المستخدم جميع الصلاحيات على القاعدة

### 3. إعداد ملف .env
1. انسخ `.env.example` إلى `.env`
2. عدّل الإعدادات التالية:
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

### 4. تثبيت الحزم
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 5. إعداد Laravel
```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. صلاحيات المجلدات
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 7. إعدادات cPanel
- تأكد من أن Document Root يشير إلى مجلد `public`
- أو استخدم `.htaccess` في الجذر لتوجيه الطلبات إلى `public`

## ملاحظات مهمة
- تأكد من أن `APP_DEBUG=false` في الإنتاج
- قم بتفعيل SSL/HTTPS
- راجع ملف `.htaccess` للتأكد من عمله بشكل صحيح
- احفظ نسخة احتياطية من قاعدة البيانات بانتظام
