#!/bin/bash

# Start app with docker-compose

set -e
USER=$(whoami)

docker-compose down
sudo chown -R $USER:$USER data
docker-compose build --force-rm
docker-compose up -d --force-recreate
docker-compose ps