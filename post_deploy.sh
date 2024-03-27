#!/bin/sh


php composer_2_7_2.phar du;
php artisan config:cache;
php artisan migrate;
chmod -R 777 storage/logs/;

# update application cache
php artisan optimize;

# start the application

php artisan horizon &

php-fpm;
