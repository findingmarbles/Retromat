[![Build Status](https://travis-ci.org/findingmarbles/Retromat.svg?branch=master)](https://travis-ci.org/findingmarbles/Retromat)

* Clone git repo
```
git clone git clone https://github.com/findingmarbles/Retromat.git retromat.git retromat.git
```


# Docker Compose
Start session:
```
cd retromat.git
docker-compose up -d
docker-compose stop
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

No you can e.g. import a DB dump from the live system and import it via PHPMyAdmin.

In the Docker App, click CLI on the mariadb container for command live access to the database.

# Install
In the Docker App, click CLI on the retromat-app-php-fpm-1
```
$ cd backend
$ composer install
```
(if that fails:
https://github.com/symfony/flex/issues/836
https://github.com/symfony/flex/issues/890
```
$ composer selfupdate
$ composer update symfony/flex --no-plugins --no-scripts
```
)
Add .env.local to set mysql root PW .
```
php backend/bin/console doctrine:migrations:migrate --no-interaction
```

# Run Tests
Initially:
Create .env.test.local (e.g. by copying .env.local) with a different DB name.

On code change:
```
php backend/bin/console --env=test doctrine:database:drop --force
php backend/bin/console --env=test doctrine:database:create
php backend/bin/console --env=test doctrine:migrations:migrate --no-interaction
```
Each time:
```
php backend/bin/console --env=test cache:clear
php -d memory_limit=1000M backend/vendor/bin/phpunit -c backend
```

# Access App via Browser
In the Docker App, click "Open in Browser" on the retromat-httpd container or directly go to:
http://localhost:8080/
