FROM php:7.3-fpm AS develop

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
COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]
CMD ["php-fpm"]

# Для сборки нужно иметь vendor сразу после build,
# а не ждать, пока все поставиться в скрипте ENTRYPOINT
FROM develop AS test
COPY composer.* ./
RUN composer install --prefer-source --no-interaction --no-plugins --no-scripts