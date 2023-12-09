#!/bin/bash

function runScript {
    docker compose exec php "$@"
}

isFirstInstallation=false

if ! [ -f ".env" ]; then
    isFirstInstallation=true
fi

echo "==[ DOCKER COMPOSE UP ]==";
docker compose up -d --remove-orphans

if [ "$isFirstInstallation" = true ]; then
    ENVIRONMENT_FILE=".env.local"
    echo "==[ Copying $ENVIRONMENT_FILE to .env"
    cp $ENVIRONMENT_FILE .env
fi

echo "==[ Install composer dependencies"
runScript composer install

echo  "==[ Run database migrations"
runScript php artisan migrate

if [ "$isFirstInstallation" = true ]; then
    echo "==[ Create storage link"
    runScript php artisan storage:link

    echo "==[ Installing Laravel Passport"
    runScript php artisan passport:install
fi

echo  "==[ Opening shell in PHP service"
docker compose exec php sh
