FROM php:8.2-apache

COPY --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer

RUN apt-get update
RUN apt-get install -y zip unzip
RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite
