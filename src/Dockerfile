FROM php:7.3-fpm

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

RUN apt-get -qq update \
    && apt-get install -qy --no-install-recommends \
        libzip-dev libxml2-dev git zip unzip gnupg2 default-mysql-client \
    && curl -sL https://deb.nodesource.com/setup_11.x | bash - \
    && apt-get install -y nodejs

RUN docker-php-ext-install mysqli pdo_mysql zip mbstring xml

RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin \
        && echo "alias composer='composer'" >> /root/.bashrc \
        && composer --version

WORKDIR /var/www/html/

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer global require hirak/prestissimo

COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["php-fpm"]