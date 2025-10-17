FROM php:8.3-fpm

ARG user=doesimples
ARG uid=1000

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libssl-dev \
    ca-certificates

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-enable redis

WORKDIR /var/www

RUN chown -R $user:www-data /var/www/storage /var/www/bootstrap/cache || true
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache || true

USER $user

RUN chown -R $user:www-data /var/www && \
    chmod -R 775 /var/www

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

USER $user

RUN git config --global --add safe.directory /var/www && \
    mkdir -p /.composer/cache && chmod -R 777 /.composer
    
