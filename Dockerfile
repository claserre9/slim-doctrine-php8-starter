FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    git \
    libzip-dev \
    unzip && \
    docker-php-ext-install mysqli pdo_mysql && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . /app

COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
