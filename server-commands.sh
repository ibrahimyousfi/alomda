#!/bin/bash
# Complete Server Setup Script for cPanel
# Run this script on your server via SSH or cPanel Terminal

echo "Starting ALOMDA Setup..."

# Navigate to project directory
cd /home/swissleg/alomdatools.ma

# Create .env file
echo "Creating .env file..."
cp .env.example .env

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Install Node dependencies
echo "Installing Node dependencies..."
npm install

# Build frontend assets
echo "Building frontend assets..."
npm run build

# Generate application key
echo "Generating application key..."
php artisan key:generate

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Create storage link
echo "Creating storage link..."
php artisan storage:link

# Set permissions
echo "Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env

# Clear and cache
echo "Clearing and caching..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Setup completed!"
echo "Don't forget to:"
echo "1. Edit .env file with your database credentials"
echo "2. Set APP_URL to https://alomdatools.ma"
echo "3. Set Document Root to 'public' folder in cPanel"
