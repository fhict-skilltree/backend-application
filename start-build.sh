function dockerCompose {
    docker compose -f docker-compose.build.yml "$@";
}

# Down the stack
docker compose down --remove-orphans

echo "==[ DOCKER BUILD AND START CONTAINERS ]==";
dockerCompose up  -d --remove-orphans --build

#
