FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    ca-certificates \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    libxml2 \
    gcc \
    g++ \
    make \
    autoconf \
    libtool \
    pkg-config \
    libssl-dev \
    supervisor \
    libsasl2-dev \
    && docker-php-ext-install sockets \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /var/log/supervisor \
    && mkdir -p /etc/supervisor/conf.d


RUN git clone --depth 1 -b v2.3.0 https://github.com/edenhill/librdkafka.git /tmp/librdkafka \
    && cd /tmp/librdkafka \
    && ./configure \
    && make \
    && make install \
    && ldconfig

RUN pecl install rdkafka \
    && docker-php-ext-enable rdkafka


RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

RUN docker-php-ext-install dom xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./_docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./_docker/supervisor/conf.d/ /etc/supervisor/conf.d/

WORKDIR /var/www/html
