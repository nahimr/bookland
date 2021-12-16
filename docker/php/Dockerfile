FROM php:8.0-apache

RUN apt update && apt-get install -y \
        libzip-dev \
        zip \
        wget \
        curl \
        git \
        unzip \
	libicu-dev \
  && docker-php-ext-install zip mysqli pdo pdo_mysql intl

RUN a2enmod rewrite

VOLUME /var/www/var
VOLUME /var/www/vendor
