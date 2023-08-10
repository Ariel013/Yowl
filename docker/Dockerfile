FROM php:8.0-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Copier le projet Laravel dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances via Composer
RUN composer install

CMD ["php-fpm"]

EXPOSE 9000
