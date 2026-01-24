# Setup Retromat using Docker

Ideally, run this and be done:

```bash
./docker-dev-setup.sh
```

If you need to free up diskspace or have another reason the really start from scratch, run this before setup (careful, slow and traffic intensive, as even image caches are cleared):

```bash
docker compose down --remove-orphans --rmi local -v
docker builder prune -a -f
```

If you want to understand each step or you need a plan b or plan c, see below.

## Install Docker + Docker-Compose

* macOS: Install Docker Desktop (because Docker Engine is not available), this now inlcudes Docker-compose https://docs.docker.com/compose/install/
* AL2023 (Amazon Linux 2023): Install Docker Engine (because Docker Desktop is not available) via dnf and Docker Compose from their website.

## Start the services

```bash
docker compose --env-file docker-ports.env up -d # detach, logs at: docker compose logs -f
```

After modifications add "--build".


## Setup up the database

Run the database setup script to create the database and import the SQL dump:

```bash
docker exec -it retromat-db-1 sh -c "cd /app/backend && ./db-setup-in-docker.sh" # [DB_NAME] is usually not needed
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
echo "DATABASE_URL=mysql://root:PaSsWoRd@db:3306/retromat?serverVersion=mariadb-10.3.30" > backend/.env.local
```

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:migrations:migrate --no-interaction"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:cache:clear-result"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:cache:clear-query"
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console doctrine:cache:clear-metadata"
```

## Run Tests

On code change related to the DB (e.g. entities):

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && php bin/console --env=test doctrine:database:create --if-not-exists"
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
