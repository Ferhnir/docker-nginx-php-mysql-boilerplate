FROM php:8.2-fpm

ARG USER
ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip \
    libicu-dev \
    vim \
    nano \
    bash

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev \
    && pecl install apcu \
    && docker-php-ext-install pdo pdo_mysql intl \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80