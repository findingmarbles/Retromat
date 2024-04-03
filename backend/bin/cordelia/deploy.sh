#!/bin/bash

# go to repo
cd /var/www/virtual/retro2/retromat-deployments/retromat.git/

# get latest version from GitHub
git pull origin master

# install libs as specified in repo
composer install --working-dir=backend
## IF composer fails, try this combo:
# composer install --no-plugins --no-scripts --working-dir=backend
# composer install --working-dir=backend
## IF composer still fails, try this 2x, then the combo above:
# rm -rf backend/var/cache/*

# adapt database as specified in repo
php backend/bin/console doctrine:migrations:migrate --no-interaction

# (re-) generate templates from index.php
sh index_deploy-from-php-to-twig.sh

# make sitemap files available via symlinks
cd /var/www/virtual/retro2/retromat-deployments/retromat.git/backend/public/
rm sitemap.*
ln -s ../../../../retromat-sitemaps/* .

# clear compiled code, templates, DB cache etc. from disk, Redis RAM, PHP RAM
php backend/bin/console cache:clear --no-warmup --env=prod
redis-cli -s /home/retro2/.redis/sock FLUSHALL
uberspace tools restart php

# warm up disk part 1
php backend/bin/console cache:warmup --env=prod
# warm up disk part 2, Redis RAM, PHP RAM
curl --silent --show-error --insecure https://retromat.org/en/ -o /dev/null
