#!/bin/bash
# ============================================
# CPANEL DIAGNOSTIC - Run in Terminal (cPanel)
# Copy all output and send it for analysis
# ============================================

echo "========== 1. CURRENT PATH =========="
pwd
echo ""

echo "========== 2. PHP VERSION =========="
php -v
echo ""

echo "========== 3. LIST ROOT FILES =========="
ls -la
echo ""

echo "========== 4. .env FILE EXISTS? =========="
if [ -f .env ]; then echo "YES - .env exists"; ls -la .env; else echo "NO - .env missing!"; fi
echo ""

echo "========== 5. VENDOR FOLDER (Composer) =========="
if [ -d vendor ]; then echo "YES - vendor exists"; ls vendor | head -5; else echo "NO - run: composer install"; fi
echo ""

echo "========== 6. STORAGE PERMISSIONS =========="
ls -la storage 2>/dev/null || echo "storage not found"
ls -la storage/framework 2>/dev/null
ls -la storage/logs 2>/dev/null
ls -la bootstrap/cache 2>/dev/null
echo ""

echo "========== 7. PUBLIC FOLDER =========="
ls -la public 2>/dev/null | head -15
echo ""

echo "========== 8. ARTISAN TEST =========="
php artisan --version 2>&1
echo ""

echo "========== 9. CONFIG CHECK =========="
php artisan config:clear 2>&1
php artisan config:cache 2>&1
echo ""

echo "========== 10. LAST LOG ERRORS (if any) =========="
if [ -f storage/logs/laravel.log ]; then tail -80 storage/logs/laravel.log; else echo "No laravel.log yet"; fi
echo ""

echo "========== 11. DOCUMENT ROOT CHECK =========="
echo "Ensure your domain points to: public (e.g. public_html/yourfolder/public or document root = .../public)"
echo ""

echo "========== END DIAGNOSTIC =========="
