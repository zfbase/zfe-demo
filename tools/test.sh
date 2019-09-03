#!/bin/bash

set -e
for cest in $(ls -A tests/tests/acceptance | sed 's:.php::g'); do
  docker-compose stop sphinx mysql

  sudo rm -rf data/mysql/*
  sudo rm -rf data/sphinx/*
  sudo rm -rf data/app/sessions/* data/app/files/* data/app/temp/* data/app/logs/*
  docker-compose up -d sphinx mysql

  sleep 10 # костыль, ждем пока все контейнеры начнут работать
  echo "Starting $cest"
  docker-compose run --rm --no-deps tests vendor/bin/codecept run acceptance --fail-fast --debug $cest
done