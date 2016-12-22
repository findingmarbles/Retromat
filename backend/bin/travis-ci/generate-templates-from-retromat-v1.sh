#!/bin/bash

php index.php en twig   > backend/app/Resources/views/home/generated/index_en.html.twig
php index.php de        > backend/app/Resources/views/home/generated/index_de.html.twig
php index.php es        > backend/app/Resources/views/home/generated/index_es.html.twig
php index.php fr        > backend/app/Resources/views/home/generated/index_fr.html.twig
php index.php nl        > backend/app/Resources/views/home/generated/index_nl.html.twig

php backend/bin/console cache:clear --env=prod
