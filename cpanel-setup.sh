#!/bin/bash
# Script for cPanel Deployment

echo "Setting up Laravel for cPanel..."

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "Setup completed!"
