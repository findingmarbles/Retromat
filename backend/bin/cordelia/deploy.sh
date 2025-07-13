#!/bin/bash

if [[ "$USER" != "retro2" ]]; then
  echo  >&2
  echo "Error: This script is specific to deploying on the live host." >&2
  echo  >&2
  echo "For dev purposes, please proceed like this: README_dev_Uberspace.md" >&2
  echo  >&2
  exit 1
fi

# go to repo
cd /var/www/virtual/retro2/retromat.git/

# stop on error
set -e
set -u

trap 'echo "ERROR: Deployment failed - check the command above"; exit 1' ERR

# get latest version from GitHub

git clean -fd
git reset --hard HEAD
git fetch origin
git reset --hard origin/master

echo "✓ Successfully reset to latest origin/master"

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
cd /var/www/virtual/retro2/retromat.git/backend/public/
rm sitemap.*
ln -s ../../../retromat-sitemaps/* .

# clear compiled code, templates, DB cache etc. from disk, Redis RAM, PHP RAM
cd /var/www/virtual/retro2/retromat.git/
# https://askubuntu.com/questions/566474/why-do-i-get-directory-not-empty-when-i-try-to-remove-an-empty-directory
rm -rf backend/var/cache/prod/*
redis-cli -s /home/retro2/.redis/sock FLUSHALL
uberspace tools restart php

# warm up
php backend/bin/console cache:warmup --env=prod
curl --silent --show-error --insecure https://retromat.org/en/ -o /dev/null
