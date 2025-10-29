#!/bin/bash
# On our live server this is triggered from sh backend/bin/cordelia/deploy.sh

for lang in en de ru es fa fr nl ja pl pt-br zh; do
  php index.php "$lang" > "backend/templates/home/generated/index_${lang}.html.twig"
  # HTML files are created by the HomeController when the page is requested
  # and no HTML exists yet.
  rm -f "backend/public/${lang}/index.html"
done
# data files are created by the ActivityApiController when requested
# and no data files exist yet.
rm -f "backend/public/api/"

php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod
