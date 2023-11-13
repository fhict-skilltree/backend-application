FROM php:8.2-fpm-alpine as base

ARG BUILD_GID=1000
ARG BUILD_UID=1000

# Set the locale
ENV MUSL_LOCALE_DEPS cmake make musl-dev gcc gettext-dev libintl
ENV MUSL_LOCPATH /usr/share/i18n/locales/musl

# Install packages
RUN --mount=type=cache,target=/var/cache/apk apk --update add \
    git  \
    grep \
    nano \
    nodejs \
    npm \
    shadow \
    patch \
    openssh \
    $MUSL_LOCALE_DEPS \
    && wget https://gitlab.com/rilian-la-te/musl-locales/-/archive/master/musl-locales-master.zip \
    && unzip musl-locales-master.zip \
    && cd musl-locales-master \
    && cmake -DLOCALE_PROFILE=OFF -D CMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install \
    && cd .. \
    && rm -r musl-locales-master

ENV LANG=nl_NL.UTF-8 \
    LANGUAGE=nl_NL.UTF-8 \
    LC_TIME=nl_NL.UTF-8 \
    LC_ALL=nl_NL.UTF-8

RUN groupdel dialout && groupmod -g ${BUILD_GID} www-data && usermod -s /bin/sh -g ${BUILD_GID} -u ${BUILD_UID} www-data

COPY --from=composer:2.4.4 /usr/bin/composer /usr/bin/composer
RUN  --mount=type=bind,from=mlocati/php-extension-installer:1.5.49,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
      install-php-extensions \
          xdebug \
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
FROM composer:2.6.5 AS composer_vendor
WORKDIR /app
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN --mount=type=cache,target=/root/.composer/cache composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Local environment
FROM base AS local
EXPOSE 9000
USER www-data
CMD ["php-fpm"]