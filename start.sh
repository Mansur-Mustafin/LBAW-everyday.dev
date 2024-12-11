#!/bin/bash

(npm run dev &)
php artisan route:cache
php artisan serve --verbose