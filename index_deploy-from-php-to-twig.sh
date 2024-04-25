#!/bin/bash
# On our live server this is triggered from:
# $ backend/bin/cordelia/deploy.sh

php index.php en    twig > backend/templates/home/generated/index_en.html.twig
php index.php de    twig > backend/templates/home/generated/index_de.html.twig
php index.php es    html > backend/templates/home/generated/index_es.html.twig
php index.php fa    html > backend/templates/home/generated/index_fa.html.twig
php index.php fr    html > backend/templates/home/generated/index_fr.html.twig
php index.php nl    html > backend/templates/home/generated/index_nl.html.twig
php index.php ja    html > backend/templates/home/generated/index_ja.html.twig
php index.php pl    html > backend/templates/home/generated/index_pl.html.twig
php index.php pt-br html > backend/templates/home/generated/index_pt-br.html.twig
php index.php ru    twig > backend/templates/home/generated/index_ru.html.twig
php index.php zh    html > backend/templates/home/generated/index_zh.html.twig

php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod
