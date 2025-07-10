# Setup Retromat using Docker

## Install Docker + Docker-Compose

* macOS: Install Docker Desktop (because Docker Engine is not available), this now inlcudes Docker-compose https://docs.docker.com/compose/install/
* AL2023 (Amazon Linux 2023): Install Docker Engine (because Docker Desktop is not available) via dnf and Docker Compose from their website.

Start the services (first time or after modifications):

```bash
docker compose --env-file docker-ports.env up -d --build
```

Start the services (normally):

```bash
docker compose --env-file docker-ports.env up    # keep the shell + docker compose logs -f
docker compose --env-file docker-ports.env up -d # detach, logs at: docker compose logs
```

## Setu up the database

### Obtain a sql dump from the live DB.

Locally, outside of docker, ec2 etc. do this:

[local ~]$ ssh retro2@cordelia.uberspace.de "/usr/bin/mysqldump --defaults-file=/home/retro2/.my.cnf retro2_retromat" > retro2_retromat.sql

### Prepare the Docker DB

Open PHPMyAdmin instance running in Docker:

* macOS: In the Docker Desktop App, click "Open in Browser" on the PHPMyAdmin container or directly use a browser to go to: http://localhost:10181/
* AL2023: Set up ssh tunnel, then open http://localhost:10181/

Obtain the value of MYSQL_ROOT_PASSWORD from

```bash
/docker-compose.yml
```

to login as root.

Create the DB: 
Name: You need to use the same DB name as specified in 
.env or .env.local, at this point the author prefers to create (and import into)
retromat-local-prod to keep it separate from the local DB used for testing.
Collation: utf8mb4_unicode_ci

### Insert the sql dump into the Docker DB

Finally, import retro2_retromat.sql into the DB you just created, via command line or using PHPMyAdmin (which can actually be convenient when accessing it from a laptop through a tunnel).

## Install libraries

* macOS: In the Docker Desktop App, click CLI on the container: retromat-app-php-fpm-1
* AL2023:

```bash
docker exec -it retromat-php-fpm-1 sh
cd backend
composer install
```

or short version:

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && composer install"
```

if that fails {
https://github.com/symfony/flex/issues/836
https://github.com/symfony/flex/issues/890
```bash
composer selfupdate
composer update symfony/flex --no-plugins --no-scripts
```
}

Add .env.local to set mysql root PW .

```bash
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:cache:clear-result
php bin/console doctrine:cache:clear-query
php bin/console doctrine:cache:clear-metadata
```

## Run Tests
Initially:
Create .env.test.local (e.g. by copying .env.local) with a different DB name. 
At this point the author prefers to create retromat-local-test

On code change related to the DB (e.g. entities):

```bash
php bin/console --env=test doctrine:database:drop --force
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:migrations:migrate --no-interaction
```

ON setup and on changes to index.php:

```bash
sh index_deploy-from-php-to-twig.sh
```

On any change:

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && rm -rf var/cache && php -d memory_limit=1000M vendor/bin/phpunit"
```

Or, more specific and quicK

```bash
docker exec -it retromat-php-fpm-1 sh -c "cd /app/backend && rm -rf var/cache && php -d memory_limit=1000M vendor/bin/phpunit --filter testCachingHeaders"
```

# Access App via Browser
* macOS: In Docker Desktop, click "Open in Browser" on the retromat-httpd container or directly go to: http://localhost:10180/
* AL2023: Set up ssh tunnel, then open http://localhost:10180/
