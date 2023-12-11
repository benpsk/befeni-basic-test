#!/bin/bash
set -e
php /usr/local/bin/composer install --optimize-autoloader
exec tail -f /dev/null
