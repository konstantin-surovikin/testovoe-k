#!/bin/bash
set -e

EXECUTABLE_DIRECTORY="$(realpath "$(dirname "$0")")"
PROJECT_DIRECTORY="$(realpath "${EXECUTABLE_DIRECTORY}/../../")"

IMAGE_UID="$(id -u)"
IMAGE_GID="$(id -g)"

set -o allexport
test -f .env && source "${PROJECT_DIRECTORY}/.env"
set +o allexport

docker build \
    -t surovikin-testovoe/php:latest \
    --build-arg PUID="${IMAGE_UID}" \
    --build-arg PGID="${IMAGE_GID}" \
    "$EXECUTABLE_DIRECTORY"
