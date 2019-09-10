#!/bin/bash

# Start app with docker-compose

set -e
USER=$(whoami)

docker-compose down
sudo chown -R $USER:$USER data
docker-compose build --force-rm phpfpm
sudo sysctl -w vm.max_map_count=262144
docker-compose up -d --force-recreate sphinx mysql phpfpm web es01 es02 kibana
docker-compose ps