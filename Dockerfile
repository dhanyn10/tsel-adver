FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libsodium-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql  mbstring exif pcntl bcmath gd zip sodium

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy all of the file in folder to /src
COPY . /src
WORKDIR /src

RUN mv .env.docker .env

RUN composer update --prefer-stable

#start docker service
CMD php artisan serve --host 0.0.0.0