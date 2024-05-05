# php
FROM php:8.3-fpm

# nodejs version
ARG NODE_VERSION=20

# 独自の php.ini
COPY ./php.ini /usr/local/etc/php/php.ini
# Composer install:PHP ライブラリ管理とかのやつ
COPY --from=composer /usr/bin/composer /usr/bin/composer

#　nodeイメージからyarn,nodeをコピーする
COPY --from=node:20 /opt/yarn-* /opt/yarn
COPY --from=node:20 /usr/local/bin/node /usr/local/bin/
COPY --from=node:20 /usr/local/lib/node_modules/ /usr/local/lib/node_modules/

RUN ln -fs /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -fs /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npx \
    && ln -fs /usr/local/lib/node /usr/local/bin/nodejs \
    && ln -fs /opt/yarn/bin/yarn /usr/local/bin/yarn \
    && ln -fs /opt/yarn/bin/yarn /usr/local/bin/yarnpkg

# コンテナ内(Ubuntu)のOSにインストールしておくやつ
RUN apt-get update && \
    apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    libpq-dev \
    libmemcached-dev \
    zlib1g-dev \
    # xdebugのインストール
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html