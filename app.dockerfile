FROM php:8.3-apache

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip


RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql zip

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public/

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN service apache2 restart

#RUN chown -R www-data:www-data /var/www/html/storage /var/wwww/html/bootstrap/cache


