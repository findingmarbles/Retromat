#!/bin/bash
# On our live server this is triggered from:
# $ backend/bin/cordelia/deploy.sh

php index.php en    fullTwig    > backend/templates/home/generated/index_en.html.twig
php index.php de    fullTwig    > backend/templates/home/generated/index_de.html.twig
php index.php ru    fullTwig    > backend/templates/home/generated/index_ru.html.twig
php index.php es    partialTwig > backend/templates/home/generated/index_es.html.twig
php index.php fa    partialTwig > backend/templates/home/generated/index_fa.html.twig
php index.php fr    partialTwig > backend/templates/home/generated/index_fr.html.twig
php index.php nl    partialTwig > backend/templates/home/generated/index_nl.html.twig
php index.php ja    partialTwig > backend/templates/home/generated/index_ja.html.twig
php index.php pl    partialTwig > backend/templates/home/generated/index_pl.html.twig
php index.php pt-br partialTwig > backend/templates/home/generated/index_pt-br.html.twig
php index.php zh    partialTwig > backend/templates/home/generated/index_zh.html.twig

php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod
