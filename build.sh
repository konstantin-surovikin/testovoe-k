#!/bin/bash
set -e

IMAGE_UID="$(id -u)"
IMAGE_GID="$(id -g)"

set -o allexport
test -f .env && source ./.env
set +o allexport

docker build \
    -t surovikin-testovoe/php:latest \
    --build-arg PUID="${IMAGE_UID}" \
    --build-arg PGID="${IMAGE_GID}" \
    "$(dirname "$0")/docker/php"
