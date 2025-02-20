#!/bin/sh

exec supervisord -c /etc/supervisor.conf
exec php-fpm
