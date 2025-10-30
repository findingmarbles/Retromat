#!/bin/bash

if [[ "$USER" != "retro2" ]]; then
  echo  >&2
  echo "Error: This script is specific to deploying on the live host." >&2
  echo  >&2
  echo "For dev purposes, please proceed like this: README_dev_Uberspace.md" >&2
  echo  >&2
  exit 1
fi

mkdir -p /var/www/virtual/retro2/retromat-sitemaps/generating-now/

php /var/www/virtual/retro2/retromat.git/backend/bin/console --env=prod presta:sitemaps:dump --gzip \
  /var/www/virtual/retro2/retromat-sitemaps/generating-now/
mv /var/www/virtual/retro2/retromat-sitemaps/generating-now/* /var/www/virtual/retro2/retromat-sitemaps

rmdir /var/www/virtual/retro2/retromat-sitemaps/generating-now/
