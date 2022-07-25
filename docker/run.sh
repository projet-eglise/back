#!/bin/sh

cd /var/www

composer install
chmod 777 -R storage/

/usr/bin/supervisord -c /etc/supervisord.conf
