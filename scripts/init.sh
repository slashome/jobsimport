#!/bin/sh

echo "CREATING DOCKER CONTAINERS..."
echo "---------"
docker compose up -d --force-recreate --remove-orphans
echo

echo "ENSURING SERVICES HAVE TIME TO START..."
echo "---------"
sleep 15 # < @TODO: Find a better way to ensure services are up and running

echo "---------"
echo 'DONE.'
