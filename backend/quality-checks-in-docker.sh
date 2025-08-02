#!/bin/sh

if [ ! -d "/app/" ]; then
    echo 'This is intended to be run in the docker container, like this:'
    echo 'docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && ./quality-checks-in-docker.sh"'
    exit 1
fi

php vendor/bin/phpstan --memory-limit=2g  analyse src tests
php vendor/bin/parallel-lint --exclude /.git --exclude /app/backend/vendor --exclude /app/backend/var /app/backend/
php bin/console lint:yaml config/ translations/
php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php

# Clean up old data
rm -rf var/cache var/coverage
# Check if coverage driver is available
if php -m | grep -qE "(xdebug|pcov)"; then
    echo "Coverage driver detected - generating coverage reports..."
    mkdir -p var/coverage
    php -d memory_limit=1000M vendor/bin/phpunit --coverage-html var/coverage/html --coverage-clover var/coverage/clover.xml --coverage-text
else
    echo "No coverage driver available - running tests without coverage..."
    echo "To enable coverage, install PCOV or Xdebug in your Docker container."
    php -d memory_limit=1000M vendor/bin/phpunit
fi
