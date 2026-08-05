FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    libzip-dev zip unzip curl \
    nodejs npm

RUN docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-dev --prefer-dist

COPY package.json package-lock.json* ./
RUN npm ci

COPY . .

RUN composer dump-autoload --optimize \
    && npm run build \
    && chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]
