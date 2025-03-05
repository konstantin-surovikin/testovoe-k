FROM mlocati/php-extension-installer as extension_installer
FROM composer:latest as composer
FROM php:8.4-fpm

COPY --from=extension_installer /usr/bin/install-php-extensions /usr/bin/
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN install-php-extensions \
    bcmath \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    ftp \
    gd \
    gearman \
    hash \
    http \
    iconv \
    imagick \
    intl \
    json \
    libsodium \
    libxml \
    mbstring \
    openssl \
    pcntl \
    pcre \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    phar \
    posix \
    protobuf \
    raphf \
    simplexml \
    soap \
    sockets \
    tidy \
    tokenizer \
    xml \
    xmlreader \
    xmlwriter \
    zip \
    zlib

# Установка недостающих пакетов
RUN apt-get update && apt-get install --no-install-recommends -y locales build-essential libboost-dev libxml2-dev \
    unzip git

ARG PUID
ENV PUID ${PUID:-1000}
ARG PGID
ENV PGID ${PGID:-1000}


RUN groupmod -g "${PGID}" www-data && usermod -aG "${PGID}" -u "${PUID}" www-data
