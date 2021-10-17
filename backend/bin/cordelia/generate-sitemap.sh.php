#!/bin/bash

# on avior, sitemap generation took about 17 minutes because of the large number of plans,
# but we always want to present a consistent state to search engines, therefore:
# export into the "generating-now" directory, then publish all files at once.
#
# Need to try this on cordelia at some point in time.
#
mkdir -p /var/www/virtual/retro2/retromat-sitemaps/generating-now/

php /var/www/virtual/retro2/retromat-deployments/current/backend/bin/console --env=prod presta:sitemaps:dump --gzip \
  /var/www/virtual/retro2/retromat-sitemaps/generating-now/
mv /var/www/virtual/retro2/retromat-sitemaps/generating-now/* /var/www/virtual/retromat/retromat-sitemaps

rmdir /var/www/virtual/retro2/retromat-sitemaps/generating-now/
