#!/bin/bash

# on avior, sitemap generation takes about 17 minutes because of the large number of plans,
# but we always want to present a consistent state to search engines, therefore:
# export into the "generating-now" directory, then publish all files at once.
mkdir -p /var/www/virtual/retromat/retromat-sitemaps/generating-now/

php /var/www/virtual/retromat/retromat-deployments/current/backend/bin/console --env=prod presta:sitemaps:dump --gzip \
  /var/www/virtual/retromat/retromat-sitemaps/generating-now/
mv /var/www/virtual/retromat/retromat-sitemaps/generating-now/* /var/www/virtual/retromat/retromat-sitemaps

rmdir /var/www/virtual/retromat/retromat-sitemaps/generating-now/
