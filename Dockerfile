FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files into container
COPY . .

# Make sure permissions are okay (this will be overridden by volume)
RUN chmod +x init.sh

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

