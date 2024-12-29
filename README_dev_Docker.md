# Install Docker + Docker-Compose
* Install Docker https://docs.docker.com/desktop/setup/install/mac-install/
* Symlink docker-compose https://docs.docker.com/compose/install/
```
sudo rm /usr/local/bin/docker-compose
sudo ln -s /Applications/Docker.app/Contents/Resources/cli-plugins/docker-compose /usr/local/bin/docker-compose
```

* Clone git repo
```
git clone git clone https://github.com/findingmarbles/Retromat.git
```

# Session start / stop 
Start session:
```
cd Retromat
docker-compose up -d
```
End session:
```
docker-compose stop
```

# Prepare Database
Obtain the value of MYSQL_ROOT_PASSWORD from
```
/docker-compose.yml
```
to login as root.

In the Docker App, click "Open in Browser" on the PHPMyAdmin container or directly go to:
http://localhost:8181/

Now you can e.g. create a DB dump on the live system for download ...
```
[retro2@cordelia ~]$ /usr/bin/mysqldump --defaults-file=/home/retro2/.my.cnf retro2_retromat > retro2_retromat.sql
```
... OR directly get the output via ssh and write to local disk ...
```
[local ~]$ ssh retro2@cordelia.uberspace.de "/usr/bin/mysqldump --defaults-file=/home/retro2/.my.cnf retro2_retromat" > retro2_retromat.sql
```
... and import it via PHPMyAdmin:

Locally you need to use the same DB name as specified in 
.env or .env local, at this point the author prefers to create (and import into)
retromat-local-prod to keep it separate from the local DB used for testing.

In the Docker App, click CLI on the mariadb container for command live access to the database.

# Install
In the Docker App, click CLI on the retromat-app-php-fpm-1
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

# Run Tests
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
