FROM php:8.1.3-fpm

# install necessary alpine packages
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    dos2unix \
    supervisor \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    libfreetype6-dev \
    libcurl4-openssl-dev  \
    pkg-config  \
    libssl-dev \
    $PHPIZE_DEPS

# compile native PHP packages
RUN docker-php-ext-install \
    gd \
    pcntl \
    bcmath \
    mysqli \
    pdo_mysql

# configure packages
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install zip
RUN docker-php-ext-install sockets

# install additional packages from PECL
RUN pecl install zip
RUN docker-php-ext-enable zip
RUN pecl install igbinary
RUN docker-php-ext-enable igbinary
RUN pecl install mongodb
RUN  docker-php-ext-enable mongodb

# Set working directory
WORKDIR /var/www/gateway


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/gateway

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/gateway

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
