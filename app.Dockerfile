FROM php:8.2-fpm

# Аргументы, определенные в docker-compose.yml
ARG user
ARG uid

# Установка необходимых пакетов и расширений
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        nodejs npm libssl-dev zlib1g-dev curl git unzip libxml2-dev libpq-dev libzip-dev supervisor && \
    pecl install mongodb-1.17.0 && \
    pecl install redis && \
    docker-php-ext-install zip pcntl && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Включение расширений вручную
RUN echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini && \
    echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

# Получение последней версии Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создание системного пользователя
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Установка рабочей директории
WORKDIR /var/www

USER $user
