FROM php:8.1-fpm

RUN apt-get update && apt-get install -y curl unzip

# Убираем кеш
RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

#COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY .. /var/www/
WORKDIR /var/www/

RUN composer install
