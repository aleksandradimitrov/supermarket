#!/bin/bash

echo "📄 Setting up Laravel environment..."

# Copy .env file if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env file created"
fi

# Install Composer dependencies
composer install

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate --force

php artisan db:seed

# Optional: seed the database
# php artisan db:seed --force

echo "✅ Laravel app initialized"
