FROM php:8.4-fpm
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
           zip \
           unzip \
           p7zip-full \
           libzip-dev \
           supervisor \
    && pecl install redis
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable redis

COPY supervisor.conf /etc/supervisor.conf
COPY docker-entrypoint.sh /entrypoint.sh

RUN composer require predis/predis

ENTRYPOINT ["/entrypoint.sh"]
