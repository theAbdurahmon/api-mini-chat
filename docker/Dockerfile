FROM php:8.4-fpm-alpine

# System dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    mysql-dev

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip bcmath

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY . .

RUN composer dump-autoload --optimize

RUN apk add --no-cache linux-headers autoconf g++ make \
    && docker-php-ext-install pcntl \
    && docker-php-ext-enable pcntl \
    && apk del autoconf g++ make

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

RUN docker-php-ext-install pcntl

EXPOSE 9000

CMD ["php-fpm"]
