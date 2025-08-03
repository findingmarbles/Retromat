#!/bin/sh

if [ ! -d "/app/" ]; then
    echo 'This is intended to be run in the docker container, like this:'
    echo 'docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && ./quality-checks-in-docker.sh [--coverage]"'
    exit 1
fi

# Start timing
start_time=$(date +%s)

# Parse command line arguments
COVERAGE=false
for arg in "$@"; do
    case $arg in
        --coverage)
            COVERAGE=true
            shift
            ;;
    esac
done

php vendor/bin/phpstan --memory-limit=2g  analyse src tests
php vendor/bin/parallel-lint --exclude /.git --exclude /app/backend/vendor --exclude /app/backend/var /app/backend/
php bin/console lint:yaml config/ translations/
php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php

# Run tests with or without coverage based on flag
if [ "$COVERAGE" = true ]; then
    # Check if coverage driver is available
    if php -m | grep -qE "(xdebug|pcov)"; then
        echo ""
        echo "Coverage driver detected - generating coverage reports..."
        echo ""
        # Clean up old data
        rm -rf var/cache var/coverage
        mkdir -p var/coverage
        php -d memory_limit=1000M vendor/bin/phpunit --coverage-html var/coverage/html --coverage-clover var/coverage/clover.xml #--coverage-text
    else
        echo ""
        echo "No coverage driver available - running tests without coverage..."
        echo "To enable coverage, install PCOV or Xdebug in your Docker container."
        echo ""
        php -d memory_limit=1000M vendor/bin/phpunit --no-coverage
    fi
else
    echo ""
    echo "Running tests without coverage (use --coverage flag to enable)..."
    echo ""
    php -d memory_limit=1000M vendor/bin/phpunit --no-coverage
fi

# Calculate and display total time
end_time=$(date +%s)
total_time=$((end_time - start_time))
echo ""
echo "Total execution time: ${total_time} seconds"
