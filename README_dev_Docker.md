# Setup Retromat using Docker

## Install Docker + Docker-Compose

* macOS: Install Docker Desktop (because Docker Engine is not available), this now inlcudes Docker-compose https://docs.docker.com/compose/install/
* AL2023 (Amazon Linux 2023): Install Docker Engine (because Docker Desktop is not available) via dnf and Docker Compose from their website.

Start the services (normally):

```bash
docker compose --env-file docker-ports.env up -d # detach, logs at: docker compose logs -f
```

After modifications add "--build".


## Setup up the database

Run the database setup script to create the database and import the SQL dump:

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && ./db-setup-in-docker.sh [DB_NAME]"
```

If `DB_NAME` is not provided, it will be extracted from `DATABASE_URL` in `.env` or `.env.local`. The script will create the database with the correct collation (`utf8mb4_unicode_ci`) and import `backend/sql-dumps/retromat-anonymized.sql`.

## Install libraries

* macOS: In the Docker Desktop App, click CLI on the container: retromat-app-php-fpm-1
* AL2023:

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && composer install"
```

if that fails {
https://github.com/symfony/flex/issues/836
https://github.com/symfony/flex/issues/890
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && composer selfupdate"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && composer update symfony/flex --no-plugins --no-scripts"
```
}

Add .env.local to set mysql root PW .

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:migrations:migrate --no-interaction"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:cache:clear-result"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:cache:clear-query"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:cache:clear-metadata"
```

## Run Tests
Initially:
Create .env.test.local (e.g. by copying .env.local) with a different DB name. 
At this point the author prefers to create retromat-local-test (and for unkown reasons, while running phpunit, this now becomes retromat-local-test_test - need to find that out later).

On code change related to the DB (e.g. entities):

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console --env=test doctrine:database:drop --force"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console --env=test doctrine:database:create"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console --env=test doctrine:migrations:migrate --no-interaction"
```

ON setup and on changes to index.php:

```bash
docker exec -it retromat-php-fpm-1 sh -c "sh index_deploy-from-php-to-twig.sh"
```

On any change:

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && rm -rf var/cache && php -d memory_limit=1000M vendor/bin/phpunit"
```

Run one test:

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && rm -rf var/cache && php -d memory_limit=1000M vendor/bin/phpunit --filter testCachingHeaders"
```

Run one test file:
```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php -d memory_limit=1000M vendor/bin/phpunit tests/Controller/ActivityApiControllerTest.php"
```

# Access App via Browser
* macOS: In Docker Desktop, click "Open in Browser" on the retromat-httpd container or directly go to: http://localhost:10180/
* AL2023: Set up ssh tunnel, then open http://localhost:10180/
