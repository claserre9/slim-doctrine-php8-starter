#!/bin/bash

# Run composer install
composer install --no-scripts --no-autoloader
composer dump-autoload --optimize

# Start php-fpm service
php-fpm