#!/bin/bash

cd /var/www/virtual/retro2/retromat-deployments/retromat.git/
git pull origin master
composer install --working-dir=backend
php backend/bin/console doctrine:migrations:migrate --no-interaction
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
php backend/bin/console cache:clear --no-warmup --env=prod
redis-cli -s /home/retro2/.redis/sock FLUSHALL
php backend/bin/console cache:warmup --env=prod
uberspace tools restart php
curl --silent --show-error --insecure https://retromat.org/en/ -o /dev/null
