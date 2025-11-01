FROM php:7.4-fpm

# 必要なライブラリ・拡張をインストール
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev libonig-dev zip && \
    docker-php-ext-install intl pdo_mysql zip

# Composer インストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html