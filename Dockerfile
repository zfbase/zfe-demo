FROM php:7.3-fpm

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

RUN apt-get -qq update \
    && apt-get install -qy --no-install-recommends \
    && libzip-dev libxml2-dev git zip unzip gnupg2 \
    && curl -sL https://deb.nodesource.com/setup_11.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html/

COPY ./src/package*.json ./
#RUN npm install npm@latest -g \
#    && npm install --only=production \
#    && npm run build \
#    && npm cache clean --force \
#    && rm -rf node_modules

RUN docker-php-ext-install mysqli pdo_mysql zip mbstring xml
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin \
        && echo "alias composer='composer'" >> /root/.bashrc \
        && composer --version
#COPY ./src/composer* ./
#RUN composer install --prefer-source --no-interaction --no-suggest --optimize-autoloader

# TODO move to entry point
# COPY ./src .
#RUN npm install --only=production --no-audit \
#    && npm run build \
#    && composer install --prefer-source --no-interaction

# RUN chmod -R 777 ../data && rm -f ../data/sessions/*

