FROM php:7.1-cli
RUN apt-get update && \
    apt-get install -y \
    unzip \
    libzip-dev && \
    docker-php-ext-install zip

RUN groupadd -r app --gid=1000 &&\
useradd -r -g app --uid=1000 --home-dir=/usr/src/app --shell=/bin/bash app
