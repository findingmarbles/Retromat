[![Build Status](https://travis-ci.org/findingmarbles/Retromat.svg?branch=master)](https://travis-ci.org/findingmarbles/Retromat)

Setting up a dev instance on Uberspace
========

Only in German for know. Let us know if you need an English version.

* Alles was für redev01 erklärt wird funktioniert natürlich auch mit einem weiteren Space Namen ... da der Space Name auch system user, db user und Bestandteil etlicher Verzeichnisnamen ist, am besten in einer lokalen Kopie dieses READMEs alle Vorkommen von redev01 durch den jeweils neuen Namen ersetzen ...
* neuen Uberspace 6(!) erstellen "redev01" (U7 bekommt Redis erst später)
* (optional) SSH public key(s) bei Uberspace redev01 hinterlegen für einfachen Zugriff: https://uberspace.de/dashboard/authentication
* SSH keypair auf Uberspace redev01 erstellen und public key bei eigenem Github user eintragen
```
ssh-keygen -t rsa -b 4096
cat .ssh/id_rsa.pub 
```
* Redis config schreiben (4 Zeilen alternativ per vim in die Datei schreiben ...)
```
cd ~
echo 'unixsocket /Users/timon/.redis/sock
daemonize no
logfile stdout
port 0' > ~/.redis/conf
```
* Redis als dauerhaften Service aktivieren
```
test -d ~/service || uberspace-setup-svscan
uberspace-setup-redis 
```
* Redis PHP Extention kompilieren und aktivieren
```
uberspace-install-pecl redis
killall php-cgi
```
*  Sessions Verzeichnis anlegen
```
mkdir /var/www/virtual/redev01/sessions
```
* Composer installieren
```
cd ~
test -d ~/bin || mkdir ~/bin  
curl -sS https://getcomposer.org/installer | php -- --install-dir=./bin --filename=composer  
```
* Git repo klonen
```
cd /var/www/virtual/redev01/
git clone git@github.com:findingmarbles/Retromat.git retromat.git
```
* Config template als aktive Config
```
cd /var/www/virtual/redev01/retromat.git/
cp backend/app/config/parameters.yml.redev backend/app/config/parameters.yml
```
* Config editieren ...
```
vim /var/www/virtual/redev01/retromat.git/backend/app/config/parameters.yml
```
... diese Werte von Hand setzen:
```
database_name: redev01_retromat
database_user: redev01
database_password: (siehe cat ~/.my.cnf )
redis_connection: (home dir, z.B. /home/redev01/.redis/sock )
```
* Libraries installieren
```
cd /var/www/virtual/redev01/retromat.git/backend
composer install
```
* DB anlegen
```
bin/console doctrine:database:create
```
* Aktuellen live DB Dump besorgen ...
* ... AUF AVIOR ... 
```
/usr/bin/mysqldump --defaults-file=/home/retromat/.my.cnf --databases retromat_v2 > ~/retromat-dev.sql
```
*  ... LOKAL ... 
```
scp retromat@avior.uberspace.de:retromat-dev.sql .
scp retromat-dev.sql redev01@canopus.uberspace.de:
```
*  ... alle weiteren Kommandos wieder auf dem neuen Uberspace!!
* Dev DB anlegen
```
cd /var/www/virtual/redev01/retromat.git/backend
bin/console doctrine:database:create
```
* Aktuellen live DB Dump anpassen:
```
vim ~/retromat-dev.sql
```
Die ersten zwei nicht-Kommentar Zeilen (CREATE DATABASE ... USE ...) editieren, neuen DB Name ( redev01_retromat einsetzten)
* Editierten DB Dump einpspielen:
```
cd ~
cat retromat-dev.sql | mysql
cd /var/www/virtual/redev01/retromat.git/backend
bin/console doctrine:schema:validate
```
* Templates aus index.php erstellen
```
cd /var/www/virtual/redev01/retromat.git/
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
```
* Web Verzeichnis von Symfony per Symlink im Web sichtbar machen
```
cd /var/www/virtual/redev01
ln -s retromat.git/backend/web/ redev01.canopus.uberspace.de
```

* Und nun ist diese Dev Instanz im Web erreichbar:
```
https://redev01.canopus.uberspace.de/
```
# Clear caches so you can see changes
* Re-generate Twig templates from index.php - technically speaking not really a cache, but something you need to clear manually in order to get to see your changes
```
cd /var/www/virtual/redev01/retromat.git/
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
```
* You can clear actual caches on the server like this:
```
cd /var/www/virtual/redev01/retromat.git/backend
bin/console cache:clear --no-warmup --env=prod
bin/console cache:clear --no-warmup --env=dev
redis-cli -s /home/retromat/.redis/sock FLUSHALL
```
* We allow browser caching for HTML and assets (JS, CSS), so you may need to clear your browser cache as well. Some browsers allow disabling caches while the developer tools are open.

# Bypass some caches on dev instance for easier development
* Make your dev activities easier by bypassing some caches and using the Symfony debug toolbar. This can be achieved using the dev environment that comes with Symfony. To make it available on your dev instance (even without an SSH tunnel, like on avior) edit this file. Inside the file, inside you will find instructions on which block to comment out:
```
cd /var/www/virtual/redev01/retromat.git/backend
vim web/app_dev.php
```
* In the dev environment, some errors and warnings (that you would never notice on prod) are taken seriously. It is a good idea to take care of these. Some of them result from the fact that new Ubersapces use PHP 7.2 by default, while the live instance still runs on PHP 7.1. Anoying, but not dangerous. Just a couple more things to take care of.