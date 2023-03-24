#!/bin/bash

cd /var/www/virtual/retro2/retromat-deployments/retromat.git/
git pull origin master

cd /var/www/virtual/retro2/retromat-deployments/retromat.git/backend/
composer install
php bin/console doctrine:migrations:migrate --no-interaction
bin/travis-ci/generate-templates-from-retromat-v1.sh
php bin/console cache:clear --no-warmup --env=prod
redis-cli -s /home/retro2/.redis/sock FLUSHALL
php bin/console cache:warmup --env=prod
curl --silent --show-error --insecure https://retromat.org/en/ -o /dev/null
