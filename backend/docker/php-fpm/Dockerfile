FROM php:8.2.28-fpm-alpine3.22

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
        pcntl \
    && pecl install \
        redis \
    && docker-php-ext-enable \
        redis \
        pcntl \
    && apk del --purge \
        autoconf \
        g++ \
        make

RUN ln -s /usr/bin/php8 /usr/bin/php

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer
