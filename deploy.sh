#!/bin/bash
# BEST Clientside Deployment Script for cPanel
# Usage: bash deploy.sh

set -e

echo "========================================"
echo "  BEST Clientside - Deploy Script"
echo "========================================"

# Detect PHP path (cPanel compatible)
PHP=$(which php 2>/dev/null || command -v php 2>/dev/null || echo "/usr/local/bin/php")

echo "[1/8] Pulling latest code from GitHub..."
git pull origin main || git pull origin master

echo "[2/8] Installing composer dependencies (no-dev)..."
$PHP /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "[3/8] Installing npm dependencies and building assets..."
npm ci
npm run build

echo "[4/8] Generating app key if not exists..."
if ! grep -q "APP_KEY=base64" .env 2>/dev/null; then
    $PHP artisan key:generate --force
fi

echo "[5/8] Running database migrations..."
$PHP artisan migrate --force

echo "[6/8] Creating storage symlink..."
$PHP artisan storage:link || true

echo "[7/8] Caching config, routes, and views..."
$PHP artisan config:cache
$PHP artisan route:cache
$PHP artisan view:cache

echo "[8/8] Optimizing..."
$PHP artisan optimize

echo "========================================"
echo "  Deployment completed successfully!"
echo "========================================"
