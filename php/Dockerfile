FROM php:7.4-fpm-alpine

RUN apk add --update \
        bash \
        git \
        yarn \
        curl \
        icu-dev \
        libzip-dev \
    && docker-php-ext-install \
        zip \
        intl \
        pdo \
        pdo_mysql

WORKDIR /var/www/symfony/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

ARG UID
ARG GID
RUN adduser --disabled-password --gecos '' -u $UID -g $GID user
USER user

