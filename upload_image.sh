#!/bin/bash

# Stop execution if a step fails
set -e

IMAGE_NAME=gitlab.up.pt:5050/lbaw/lbaw2425/lbaw24041:latest

# Ensure that dependencies are available
composer install
php artisan config:clear
php artisan clear-compiled
php artisan optimize

# Tailwind
npm run build

docker buildx build --push --platform linux/amd64,linux/arm64 -t $IMAGE_NAME . --provenance=false
