FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN apt-get update && \
    apt-get install -y --no-install-recommends nodejs npm libssl-dev zlib1g-dev curl git unzip libxml2-dev libpq-dev libzip-dev supervisor&& \
    pecl install apcu  --onlyreqdep --force redis mongodb && \
    docker-php-ext-configure pcntl --enable-pcntl && \
    docker-php-ext-enable redis mongodb && \
    docker-php-ext-install pcntl && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user


# Set working directory
WORKDIR /var/www

USER $user
