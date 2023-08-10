FROM php:8.0-fpm-alpine AS builder

RUN apk add --no-cache \
    libzip-dev \
    zip

RUN docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install

FROM php:8.0-fpm-alpine

COPY --from=builder /var/www/html /var/www/html

WORKDIR /var/www/html

CMD ["php-fpm"]