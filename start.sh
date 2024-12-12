#!/bin/bash
php artisan route:cache
(npm run dev &)
php artisan route:cache
php artisan serve --verbose