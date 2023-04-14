#!/bin/bash

# go to repo
cd /var/www/virtual/retro2/retromat-deployments/retromat.git/

# get latest version from GitHub
git pull origin master

# install libs as specified in repo
composer install --working-dir=backend

# adapt database as specified in repo
php backend/bin/console doctrine:migrations:migrate --no-interaction

# (re-) generate templates from index.php
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh

# clear activities from RAM
redis-cli -s /home/retro2/.redis/sock FLUSHALL

# clear and warmup compiled code, templates etc. from disk
php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod

# clear and warmup compiled code, templates etc. from RAM
uberspace tools restart php

# warmup RAM loading a page via http
curl --silent --show-error --insecure https://retromat.org/en/ -o /dev/null
