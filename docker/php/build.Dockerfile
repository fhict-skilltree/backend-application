FROM php:8.2-fpm-alpine as base

ARG BUILD_GID=1000
ARG BUILD_UID=1000

# Install packages
RUN --mount=type=cache,target=/var/cache/apk apk --update add \
    grep \
    shadow \
    openssh

RUN groupdel dialout && groupmod -g ${BUILD_GID} www-data && usermod -s /bin/sh -g ${BUILD_GID} -u ${BUILD_UID} www-data

COPY --from=composer:2.4.4 /usr/bin/composer /usr/bin/composer
RUN  --mount=type=bind,from=mlocati/php-extension-installer:1.5.49,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
      install-php-extensions \
          opcache \
          intl \
          zip \
          redis \
          imagick \
          mcrypt \
          pdo_mysql \
          opcache \
          gd \
          exif

COPY ./docker/php/conf.d/php.ini ${PHP_INI_DIR}/conf.d/php.ini

RUN mkdir -p /var/www/html && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

# Composer dependencies
FROM composer:2.6.6 AS composer_vendor
WORKDIR /app
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN --mount=type=cache,target=/root/.composer/cache composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM base AS app

COPY ./artisan ./artisan
COPY ./bootstrap ./bootstrap

COPY --from=composer_vendor ./app/vendor/ ./vendor

COPY ./config ./config
COPY ./database ./database
COPY ./public ./public
COPY ./routes ./routes
COPY ./storage ./storage
COPY ./app ./app

EXPOSE 9000
USER www-data
CMD ["php-fpm"]
