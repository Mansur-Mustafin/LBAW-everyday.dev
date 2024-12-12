#!/bin/bash
php artisan route:cache
(npm run dev &)
php artisan serve --verbose