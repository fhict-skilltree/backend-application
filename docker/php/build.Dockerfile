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

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html

# Composer dependencies
FROM composer:2.6.6 AS composer_vendor
WORKDIR /app
COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock

RUN --mount=type=cache,target=/root/.composer/cache composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM base AS build

COPY --chown=wodby:wodby ./artisan ./artisan
COPY --chown=wodby:wodby ./bootstrap ./bootstrap

COPY --chown=wodby:wodby ./composer.json ./composer.json
COPY --chown=wodby:wodby --from=composer_vendor ./app/vendor/ ./vendor

COPY --chown=wodby:wodby ./config ./config
COPY --chown=wodby:wodby ./database ./database
COPY --chown=wodby:wodby ./public ./public
COPY --chown=wodby:wodby ./routes ./routes
COPY --chown=wodby:wodby ./storage ./storage
COPY --chown=wodby:wodby ./app ./app

FROM build AS app
EXPOSE 9000
CMD ["php-fpm"]
