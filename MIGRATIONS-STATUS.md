# Database Migrations Status

## Available Migrations

All migrations are ready and configured for MySQL database.

### Core Laravel Migrations
1. ✅ `0001_01_01_000000_create_users_table.php` - Users, password reset tokens, sessions
2. ✅ `0001_01_01_000001_create_cache_table.php` - Cache table
3. ✅ `0001_01_01_000002_create_jobs_table.php` - Jobs and job batches

### Application Migrations
4. ✅ `2026_02_10_100943_create_categories_table.php` - Categories table
5. ✅ `2026_02_10_100945_create_products_table.php` - Products table
6. ✅ `2026_02_10_100946_create_orders_table.php` - Orders table
7. ✅ `2026_02_10_100948_create_order_items_table.php` - Order items table
8. ✅ `2026_02_11_111855_add_parent_and_icon_to_categories_table.php` - Parent category support

## Database Tables Structure

### users
- id, name, email, password, remember_token, timestamps

### categories
- id, parent_id (nullable), is_parent, icon (nullable), name_ar, name_en, slug, image, timestamps

### products
- id, category_id, name_ar, name_en, slug, description_ar, description_en, price, stock, image, images (JSON), is_featured, timestamps

### orders
- id, customer_name, customer_phone, customer_address, total_amount, status, notes, timestamps

### order_items
- id, order_id, product_id, quantity, price, timestamps

## Commands to Run Migrations

### On Local Development
```bash
php artisan migrate
php artisan migrate --seed
```

### On Production Server
```bash
php artisan migrate --force
php artisan migrate --seed --force
```

### Check Migration Status
```bash
php artisan migrate:status
```

### Rollback Last Migration
```bash
php artisan migrate:rollback
```

### Rollback All Migrations
```bash
php artisan migrate:reset
```

### Fresh Migration (Drop all tables and re-run)
```bash
php artisan migrate:fresh
php artisan migrate:fresh --seed
```

## Important Notes

- All migrations are configured for **MySQL** database
- Foreign key constraints are enabled
- Cascade delete is configured for related records
- Make sure database credentials are correct in `.env` file before running migrations
