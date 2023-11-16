#!/bin/bash

function runScript {
    docker compose exec php "$@"
}

function initializeProject() {
    if ! [ -f ".env" ]; then
        ENVIRONMENT_FILE=".env.local"
        echo "==[ Copying $ENVIRONMENT_FILE to .env"
        cp $ENVIRONMENT_FILE .env

        echo "==[ Create storage link"
        runScript php artisan storage:link
    fi
}

echo "==[ DOCKER COMPOSE UP ]==";
docker compose up -d --remove-orphans

initializeProject

echo "==[ Install composer dependencies"
runScript composer install

echo  "==[ Run database migrations"
runScript php artisan migrate

echo  "==[ Opening shell in PHP service"
docker compose exec php sh
