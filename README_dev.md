[![Build Status](https://travis-ci.org/findingmarbles/Retromat.svg?branch=master)](https://travis-ci.org/findingmarbles/Retromat)

Setting up a dev instance on Uberspace
========

* Register a new UberSpace https://uberspace.de/register

* Ensure the right (tm) version of PHP, see .travis.yml for which one you need, then activate that one on the new uberspace like this:
```
uberspace tools version use php 7.4
```

* Setup Redis service https://lab.uberspace.de/guide_redis.html

* Obtain DB dump from live retromat.org (make a fresh dump of only retromat db, avoid blog and analytics DB ...), put it on the new space
```
# ssh <SpaceNameLive>@c....uberspace.de
mysqldump --defaults-file=/home/<SpaceNameLive>/.my.cnf --databases <SpaceNameLive>_retromat > <SpaceNameLive>_retromat.sql
# local
scp <SpaceNameLive>@c....uberspace.de:<SpaceNameLive>_retromat.sql .
scp <SpaceNameLive>_retromat.sql <SpaceNameDev>@canopus.uberspace.de:
```
* on the new UberSpace: gunzip DB dump (if .gz), edit it and comment out "create db" and "use db" im present, then create new DB and import dump
```
# ssh <SpaceNameDev>@canopus.uberspace.de
echo 'CREATE DATABASE <SpaceNameDev>_retromat'| mysql --defaults-file=/home/<SpaceNameDev>/.my.cnf
mysql --defaults-file=/home/<SpaceNameDev>/.my.cnf <SpaceNameDev>_retromat <  retro2_retromat.sql
```
* Clone git repo
```
cd /var/www/virtual/<SpaceNameDev>/
git clone git clone https://github.com/findingmarbles/Retromat.git retromat.git retromat.git
```
* Copy config template as active config
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/
cp backend/app/config/parameters.yml.dist backend/app/config/parameters.yml
```
* Edit config to reflect properties of current space (db host: localhost, db password from ~/.my.cnf etc.)...
```
vim /var/www/virtual/<SpaceNameDev>/retromat.git/backend/app/config/parameters.yml
```
... Create sessions dir and adjust path in parameters.yml
```
mkdir /var/www/virtual/<SpaceNameDev>/sessions
```
... set redis connection in parameters.yml
```
redis_connection: (home dir, z.B. /home/<SpaceNameDev>/.redis/sock )
```
* Install libraries
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/backend
composer install
```

* Create temaples from index.php
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
```
* Make web directory visible
```
cd /var/www/virtual/<SpaceNameDev>
ln -s retromat.git/backend/web/ <SpaceNameDev>.uber.space
```
* And now this instance is availabe here: https://<username>.uber.space/robots.txt

# Clear caches so you can see changes
* Re-generate Twig templates from index.php - technically speaking not really a cache, but something you need to clear manually in order to get to see your changes
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
```
* You can clear actual caches on the server like this:
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/backend
bin/console cache:clear --no-warmup --env=prod
bin/console cache:clear --no-warmup --env=dev
redis-cli -s /home/<SpaceNameDev>/.redis/sock FLUSHALL
```
* We allow browser caching for HTML and assets (JS, CSS), so you may need to clear your browser cache as well. Some browsers allow disabling caches while the developer tools are open.

# Bypass some caches on dev instance for easier development
* Make your dev activities easier by bypassing some caches and using the Symfony debug toolbar. This can be achieved using the dev environment that comes with Symfony. To make it available on your dev instance (even without an SSH tunnel, like on avior) edit this file. Inside the file, you find instructions on which block to comment out:
```
vim /var/www/virtual/<SpaceNameDev>/retromat.git/backend/web/app_dev.php
```
* In the example, this has been done already, so if you want to see this
```
https://<SpaceNameDev>.uber.space/en/?id=114-54-26-38-15
```
* ... but bypass most caches and see the debug toolbar see ...
```
https://<username>.uber.space/app_dev.php/en/?id=114-54-26-38-15
```
So basically replace ".space/" with ".space/app_dev.php/" in the URL.

# Debug
* See here for lowlevel PHP logs (may be empty, as most are handeled by Symfony)
https://manual.uberspace.de/web-logs/#error-log-php
~/logs/error_log_php
* See here for Symfony logs
/var/www/virtual/<SpaceNameDev>/retromat.git/backend/var/logs

# Run all tests
```
cd /var/www/virtual/<username>/retromat.git/backend
vendor/bin/simple-phpunit
```
