#!/bin/bash

# создадим копию даты для тестов
# для этого надо положить контейнеры, иначе данные будут "битыми"
docker-compose down 2> /dev/null
sudo rm -rf data_copy
sudo cp -rp data data_copy
sudo rm -rf data_copy/app/sessions/* data_copy/app/files/* data_copy/app/temp/* data_copy/app/logs/*

# возвратить все как было
function restore() {
  sudo rm -rf data
  sudo mv -f data_copy data
}

# берем каждый файл с набором тестов
for cest in $(ls -A tests/tests/acceptance | sed 's:.php::g'); do
  # обновляем папку
  sudo rm -rf data
  sudo cp -rp data_copy data

  # запускаем контейнеры
  docker-compose up -d 2> /dev/null
  # docker-compose ps

  sleep 5 # костыль, ждем пока все контейнеры начнут работать
  # echo "Starting $cest"
  docker-compose run --rm --no-deps tests vendor/bin/codecept run acceptance --fail-fast --debug --report $cest
  rc=$?
  docker-compose down 2> /dev/null
  if [[ $rc -ne 0 ]]; then
    restore
    exit $rc
  fi
done

restore