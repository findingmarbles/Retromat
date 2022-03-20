FROM php:8.1-fpm-alpine

WORKDIR /app

RUN apk update \
    && apk add --no-cache \
        git \
        zip \
        wget \
        gpg \
        libpq-dev \
        nodejs \
        yarn \
        autoconf \
        g++ \
        make \
    && docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
    && pecl install \
        redis \
    && docker-php-ext-enable \
        redis \
    && apk del --purge \
        autoconf \
        g++ \
        make

RUN ln -s /usr/bin/php8 /usr/bin/php

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer
