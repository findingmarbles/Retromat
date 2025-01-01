#!/bin/bash
# On our live server this is triggered from:
# $ backend/bin/cordelia/deploy.sh

for lang in en de ru es fa fr nl ja pl pt-br zh; do
  php index.php "$lang" > "backend/templates/home/generated/index_${lang}.html.twig"
done

php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod
