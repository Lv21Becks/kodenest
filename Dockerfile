FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000