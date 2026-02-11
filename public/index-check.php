<?php
/**
 * Quick Check Script for cPanel
 * Access this file directly to check if PHP and paths are working
 * Example: https://yourdomain.com/index-check.php
 */

echo "<h1>ALOMDA - Server Check</h1>";
echo "<hr>";

// Check PHP Version
echo "<h2>PHP Version:</h2>";
echo "<p>" . phpversion() . "</p>";
echo "<p>" . (version_compare(phpversion(), '8.2.0', '>=') ? '✅ OK' : '❌ Need PHP 8.2+') . "</p>";

// Check if vendor exists
echo "<h2>Vendor Folder:</h2>";
echo "<p>" . (file_exists(__DIR__ . '/../vendor/autoload.php') ? '✅ Exists' : '❌ Missing - Run: composer install') . "</p>";

// Check if .env exists
echo "<h2>.env File:</h2>";
echo "<p>" . (file_exists(__DIR__ . '/../.env') ? '✅ Exists' : '❌ Missing - Copy .env.example to .env') . "</p>";

// Check storage permissions
echo "<h2>Storage Permissions:</h2>";
$storagePath = __DIR__ . '/../storage';
echo "<p>Storage: " . (is_writable($storagePath) ? '✅ Writable' : '❌ Not Writable - Run: chmod -R 755 storage') . "</p>";

// Check bootstrap/cache permissions
$cachePath = __DIR__ . '/../bootstrap/cache';
echo "<p>Bootstrap/Cache: " . (is_writable($cachePath) ? '✅ Writable' : '❌ Not Writable - Run: chmod -R 755 bootstrap/cache') . "</p>";

// Check if public/build exists
echo "<h2>Build Assets:</h2>";
echo "<p>" . (file_exists(__DIR__ . '/build') ? '✅ Exists' : '❌ Missing - Run: npm install && npm run build') . "</p>";

// Check mod_rewrite
echo "<h2>mod_rewrite:</h2>";
echo "<p>" . (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()) ? '✅ Enabled' : '⚠️ Check with hosting') . "</p>";

echo "<hr>";
echo "<p><strong>If all checks pass, try accessing the main site.</strong></p>";
echo "<p><a href='index.php'>Go to Main Site</a></p>";
