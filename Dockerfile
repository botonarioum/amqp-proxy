FROM php:8.1-fpm

RUN apt update \
    && apt-get -y install git libzip-dev \
    && docker-php-ext-install zip

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash

EXPOSE 9000
CMD ["php-fpm"]