#!/bin/bash

docker-compose down

# Remove all Docker images
# shellcheck disable=SC2046
docker rmi $(docker images -a -q) -f

# Remove all Docker volumes
# shellcheck disable=SC2046
docker volume rm $(docker volume ls -q)