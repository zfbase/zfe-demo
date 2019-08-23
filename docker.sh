#!/bin/bash
set -e
USER=$(whoami)

docker-compose down
sudo chown -R $USER:$USER data
docker-compose build --force-rm
docker-compose up -d --force-recreate