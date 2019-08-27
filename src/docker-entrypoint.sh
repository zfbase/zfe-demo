#!/bin/bash
set -e

# mkdir -pv ../data/app ../data/files ../data/sessions ../data/temp ../data/logs

# php-fpm work under www-data
chmod -R 777 ../* && chown -R www-data:www-data ../*
composer install --prefer-source --no-interaction --no-plugins --no-scripts
npm install --only=production --no-audit
npm run build

# @see https://github.com/docker-library/php/blob/135204c0f4c7a255ee70ec82dc1133929f9676c0/7.3/buster/fpm/docker-php-entrypoint
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

exec "$@"