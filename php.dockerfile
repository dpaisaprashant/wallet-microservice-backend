FROM php:8.0.6-fpm-alpine

ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel && \
    mkdir -p /var/www/html && \
    chown -R laravel:laravel /var/www/html && \
    mkdir -p /var/www/html/storage && \
    chown -R laravel:laravel /var/www/html/storage && \
    mkdir -p /var/www/html/bootstrap/cache && \
    chown -R laravel:laravel /var/www/html/bootstrap/cache && \
    mkdir -p /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql && \
    apk update && \
    apk add --no-cache libpng libpng-dev && \
    docker-php-ext-install gd && \
    apk del libpng-dev && \
    apk add --update --virtual build_deps bash gcc g++ autoconf make openssl-dev pcre-dev && \
    docker-php-source extract && \
    /bin/bash -lc "pecl install -f mongodb-1.9.1.tgz" && \
    docker-php-ext-enable mongodb && \
    docker-php-source delete && \
    apk del build_deps && \
    rm -rf /var/cache/apk/* && \
    rm -rf /tmp/*