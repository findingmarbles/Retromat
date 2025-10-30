Deploy to LIVE instance on Uberspace
========
```
# ssh <SpaceNameLive>@c....uberspace.de
cd /var/www/virtual/ ... /retromat.git/
sh backend/bin/cordelia/deploy.sh
```

Using an existing DEV instance on Uberspace
========
Let's assume you don't need to make changes to backend or activities right now.

Then:

To see frontend-only changes:

1. Get the lastest code
2. (re-) generate templates from index.php (the script is at repo toplevel)
```
./index_deploy-from-php-to-twig.sh
```
If anything is weird (long time since last checkout, lots of changes, ...), then work through the long version of the steps below:

Go to repo
```
cd /var/www/virtual/ ... /retromat.git/
```

Get latest version from GitHub
```
git pull origin master
```

if something is weird, check out:
```
git status
```
Cleanup:
```
git reset --hard
```
Maybe delete changed files manually, repeat steps named above.

This could also help (to get out of a dangling HEAD state):
```
git checkout master
```

Install libraries as defined in repo:
```
composer install --working-dir=backend
```
ONLY IF composer fails, try this combo:
```
composer install --no-plugins --no-scripts --working-dir=backend
composer install --working-dir=backend
```
ONLY IF composer still fails, try this 2x, then the combo above:
```
rm -rf backend/var/cache/*
```

Adapt database automatically using our defined migrations:
```
php backend/bin/console doctrine:migrations:migrate --no-interaction
```

Clear compiled code, templates, DB cache etc. from disk, Redis RAM, PHP RAM
```
rm -rf backend/var/cache
redis-cli -s /home/retrodev/.redis/sock FLUSHALL
```
Clear and warmup disk cache
```
php backend/bin/console cache:clear --no-warmup --env=prod
php backend/bin/console cache:warmup --env=prod
```

(re-) generate templates from index.php (the script is at repo toplevel) 
```
./index_deploy-from-php-to-twig.sh
```

On a dev instance you can usually skip this step:
But do it if something is weird:
Clear and warmup compiled code, templates etc. from RAM
```
uberspace tools restart php
```

Everything should be totally fresh at this point.

Setting up a dev instance on Uberspace
========

* Register a new UberSpace https://uberspace.de/register

* Ensure the right (tm) version of PHP, see .travis.yml for which one you need, then activate that one on the new uberspace like this:
```
uberspace tools version use php 8.8
```

* Setup Redis service https://lab.uberspace.de/guide_redis.html

* OPTIONAL (you can import example activities instead, as described later): Obtain DB dump from live retromat.org (make a fresh dump of only retromat db, avoid blog and analytics DB ...), put it on the new space
```
# ssh <SpaceNameLive>@c....uberspace.de
mysqldump --defaults-file=/home/<SpaceNameLive>/.my.cnf --databases <SpaceNameLive>_retromat > <SpaceNameLive>_retromat.sql
# local
scp <SpaceNameLive>@c....uberspace.de:<SpaceNameLive>_retromat.sql .
scp <SpaceNameLive>_retromat.sql <SpaceNameDev>@canopus.uberspace.de:
```
* OPTIONAL (you can import example activities instead, as described later): gunzip DB dump (if .gz), edit it and comment out "create db" and "use db" im present, then create new DB and import dump
```
# ssh <SpaceNameDev>@canopus.uberspace.de
echo 'CREATE DATABASE <SpaceNameDev>_retromat'| mysql --defaults-file=/home/<SpaceNameDev>/.my.cnf
mysql --defaults-file=/home/<SpaceNameDev>/.my.cnf <SpaceNameDev>_retromat <  <SpaceNameLive>_retromat.sql
```
* Clone git repo
```
cd /var/www/virtual/<SpaceNameDev>/
git clone git clone https://github.com/findingmarbles/Retromat.git retromat.git
```
* Copy .env as .env.local and edit to reflect properties of current space (db host: localhost, db password from ~/.my.cnf etc.)...

```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/
cp backend/.env backend/.env.local
vim /var/www/virtual/<SpaceNameDev>/retromat.git/backend/.env.local
```
... (@TODO UPDATE THIS - WHERE TO CONFIGURE?) Create sessions dir and adjust path in parameters.yml
```
mkdir /var/www/virtual/<SpaceNameDev>/sessions
```
... set redis connection in .env.local
```
REDIS_URL="redis:///home/<SpaceNameDev>/.redis/sock"
```
* Install libraries (this will try to clear the cache, which can cause problems in an incomplete setup. In that case, re-run the command, if that doesn't help fix / continue, then redo this step later)
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/backend
composer install
```
* Set up the database structure (skip if you imported a full dump from live, see OPTIONAL step higher up)
```
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
```
 
* Import example content into the database  (skip if you imported a full dump from live, see OPTIONAL step higher up)
```
bin/console retromat:import:activities
```

* Create templates from index.php
```
cd /var/www/virtual/<SpaceNameDev>/retromat.git/
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
```
* Make web directory visible
```
cd /var/www/virtual/<SpaceNameDev>
ln -s retromat.git/backend/web/ <SpaceNameDev>.uber.space
```
* And now this instance is availabe here: https://<SpaceNameDev>.uber.space/robots.txt

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
Sometimes running cache:clear is not enough. In these cases this helps:
```
rm -rf backend/var/cache
```
* We allow browser caching for HTML and assets (JS, CSS), so you may need to clear your browser cache as well. Some browsers allow disabling caches while the developer tools are open.

# Bypass some caches on dev instance for easier development
Make your dev activities easier by bypassing some caches and using the Symfony debug toolbar. This can be achieved using the dev environment that comes with Symfony: Edit .env.local  as follows:
```
APP_ENV=dev
```

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
