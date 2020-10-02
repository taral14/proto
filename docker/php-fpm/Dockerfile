FROM php:fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk update \
    && apk add curl php-cli php-mbstring git unzip protobuf \
    && docker-php-ext-install sockets bcmath

RUN apk add rabbitmq-c-dev \
    && apk add --virtual .phpize-deps $PHPIZE_DEPS \
    && pecl install -o -f amqp \
    && docker-php-ext-enable amqp \
    && apk del .phpize-deps