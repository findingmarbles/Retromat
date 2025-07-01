# Setup Retromat using Docker

## Install Docker + Docker-Compose

* macOS: Install Docker Desktop (because Docker Engine is not available), this now inlcudes Docker-compose https://docs.docker.com/compose/install/
* AL2023 (Amazon Linux 2023): Install Docker Engine (because Docker Desktop is not available) via dnf and Docker Compose from their website.

## Session start 

```
docker compose up -d
```

## Obtain a sql dump fron the live DB.

Locally, outside of docker, ec2 etc. do this:

[local ~]$ ssh retro2@cordelia.uberspace.de "/usr/bin/mysqldump --defaults-file=/home/retro2/.my.cnf retro2_retromat" > retro2_retromat.sql

## Insert the sql dump into the Docker DB:

## Prepare Database

Open PHPMyAdmin instance running in Docker:

* macOS: In the Docker Desktop App, click "Open in Browser" on the PHPMyAdmin container or directly use a browser to go to: http://localhost:8181/
* AL2023: Set up ssh tunnelm then open http://localhost:8181/

Obtain the value of MYSQL_ROOT_PASSWORD from
```
/docker-compose.yml
```
to login as root.

Create the DB: 
Name: You need to use the same DB name as specified in 
.env or .env.local, at this point the author prefers to create (and import into)
retromat-local-prod to keep it separate from the local DB used for testing.
Collation: utf8mb4_unicode_ci

Then import retro2_retromat.sql 

* macOS: In the Docker Desktop App, click CLI on the container: retromat-app-php-fpm-1
* AL2023:

```
docker exec -it retromat-php-fpm-1 sh
```

## Install libraries

```
cd backend
composer install
```
(if that fails:
https://github.com/symfony/flex/issues/836
https://github.com/symfony/flex/issues/890
```
composer selfupdate
composer update symfony/flex --no-plugins --no-scripts
```
)
Add .env.local to set mysql root PW .
```
php backend/bin/console doctrine:migrations:migrate --no-interaction
php backend/bin/console doctrine:cache:clear-result
php backend/bin/console doctrine:cache:clear-query
php backend/bin/console doctrine:cache:clear-metadata
```

## Run Tests
Initially:
Create .env.test.local (e.g. by copying .env.local) with a different DB name. 
At this point the author prefers to create retromat-local-test

On code change related to the DB (e.g. entities):
```
php backend/bin/console --env=test doctrine:database:drop --force
php backend/bin/console --env=test doctrine:database:create
php backend/bin/console --env=test doctrine:migrations:migrate --no-interaction
```
On changes to index.php:
```
sh index_deploy-from-php-to-twig.sh
```
On any change:
```
php backend/bin/console --env=test cache:clear ; php -d memory_limit=1000M backend/vendor/bin/phpunit -c backend
```
OR
```
cd backend
php bin/console --env=test cache:clear ; php -d memory_limit=1000M vendor/bin/phpunit
```

Known Docker specific issues at this point:

Sometimes running cache:clear is not enough. In these cases this helps:
```
rm -rf backend/var/cache
```

All test were green on Travis-CI, before we stopped using it.

BUT:
These failed in Docker:
App\Tests\Controller\TeamActivityControllerTest::testCreateNewActivityUsesNextFreeRetromatIdFullDb
App\Tests\Repository\ActivityRepositoryTest::testFindAllActivitiesForPhases
App\Tests\Repository\ActivityRepositoryTest::testFindAllActivitiesForPhasesDe

AND:
When sleeping 1 s after loading fixtures into the DB they succeed. 
WTF? This is on a MBP with M2 CPU and 16 GB RAM, why would it need a delay? 
Anyway, all tests green again.

# Access App via Browser
In the Docker App, click "Open in Browser" on the retromat-httpd container or directly go to:
http://localhost:8080/
