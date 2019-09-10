# ZFE Demo

Чтобы (пере)поднять окружение, используя docker-compose:
```bash
./tools/start.sh
```

Чтобы начать работать осталось установить зависимости:
```bash
docker-compose exec phpfpm composer install --prefer-source --no-interaction --no-plugins --no-scripts
docker-compose exec phpfpm npm install --only=production --no-audit
docker-compose exec tests composer install --prefer-source --no-interaction --no-plugins --no-scripts
```

Чтобы построить ассеты делаем:
```bash
docker-compose exec phpfpm npm run build
```

## Приемочные тесты

**Сборка в TeamCity** запустит сервисы и прогонит приемочные. При выполнении каждый Cest будет запускаться в своем окружении

## Elasticsearch

* [Installation](https://www.elastic.co/guide/en/elasticsearch/reference/7.3/docker.html)
* [Virtual memory for ES](https://www.elastic.co/guide/en/elasticsearch/reference/current/vm-max-map-count.html)
* [Solution for Exit 78 error, links to Virtual memory for ES](https://stackoverflow.com/a/53097050)

Example of ES with docker:
```bash 
sudo sysctl -w vm.max_map_count=262144 
docker pull docker.elastic.co/elasticsearch/elasticsearch:7.3.1
docker run -p 9200:9200 -p 9300:9300 -e "discovery.type=single-node" docker.elastic.co/elasticsearch/elasticsearch:7.3.1
```

## Kibana



