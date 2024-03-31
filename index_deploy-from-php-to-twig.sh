#!/bin/bash

# How to:
# Execute this comand from the toplevel directory of your Retromat repository,
# which is where index.php is currently located.

# Background:
# No cd ... or absolute paths here, because
# this command needs to work on local machines and on travis-ci, too.

php index.php en    twig ajax > backend/templates/home/generated/index_en.html.twig
php index.php de    twig ajax > backend/templates/home/generated/index_de.html.twig
php index.php es    html ajax > backend/templates/home/generated/index_es.html.twig
php index.php fa    html ajax > backend/templates/home/generated/index_fa.html.twig
php index.php fr    html ajax > backend/templates/home/generated/index_fr.html.twig
php index.php nl    html ajax > backend/templates/home/generated/index_nl.html.twig
php index.php ja    html ajax > backend/templates/home/generated/index_ja.html.twig
php index.php pl    html ajax > backend/templates/home/generated/index_pl.html.twig
php index.php pt-br html ajax > backend/templates/home/generated/index_pt-br.html.twig
php index.php ru    twig ajax > backend/templates/home/generated/index_ru.html.twig
php index.php zh    html ajax > backend/templates/home/generated/index_zh.html.twig

php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod
