#!/bin/bash

# on avior, sitemap generation took about 17 minutes because of the large number of plans,
# but we always want to present a consistent state to search engines, therefore:
# export into the "generating-now" directory, then publish all files at once.
#
# Need to try this on cordelia at some point in time.
#
# Before you re-generate the sitemap, tweak $maxResults and $skip used in PlanIdGenerator->generate(
# Hint: Google sometimes covers millions of pages (5 mio in April 2022) and sometimes hundreds of thousands (670 k in July 2022).

mkdir -p /var/www/virtual/retro2/retromat-sitemaps/generating-now/

php /var/www/virtual/retro2/retromat.git/backend/bin/console --env=prod presta:sitemaps:dump --gzip \
  /var/www/virtual/retro2/retromat-sitemaps/generating-now/
mv /var/www/virtual/retro2/retromat-sitemaps/generating-now/* /var/www/virtual/retromat/retromat-sitemaps

rmdir /var/www/virtual/retro2/retromat-sitemaps/generating-now/
