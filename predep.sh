#!/bin/bash

php artisan config:cache
php artisan config:clear
php artisan storage:link
chmod -R 775 storage
chmod -R 775 bootstrap/cache
