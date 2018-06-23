[![Build Status](https://travis-ci.org/findingmarbles/Retromat.svg?branch=master)](https://travis-ci.org/findingmarbles/Retromat)

Setting up a dev environment on Uberspace
========

Only in German for know. Let us know if you need an English version.

* alles was für redev01 erklärt wird funktioniert natürlich auch mit einem weiteren Space Namen ... da der Space Name auch system user, db user und Bestandteil etlicher Verzeichnisnamen ist, am besten alle Vorkommen von redev01 durch denen jeweils neuen Namen ersetzen ...
* neuen Uberspace 6(!) erstellen "redev01"
* (optional) SSH public key(s) bei Uberspace redev01 hinterlegen für einfachen Zugriff: https://uberspace.de/dashboard/authentication
* SSH Keypair auf Uberspace redev01 erstellen und public key bei eigenem Github user eintragen
```
ssh-keygen -t rsa -b 4096
cat .ssh/id_rsa.pub 
```
* redis config schreiben (4 Zeilen alternativ per vim in die Datei schreiben ...)
```
cd ~
echo 'unixsocket /Users/timon/.redis/sock
daemonize no
logfile stdout
port 0' > ~/.redis/conf
```
* redis als dauerhaften service aktivieren
```
test -d ~/service || uberspace-setup-svscan
uberspace-setup-redis 
```
* redis php extention kompilieren und aktivieren
```
uberspace-install-pecl redis
killall php-cgi
```
* create sessions dir
```
mkdir /var/www/virtual/redev01/sessions
```
* composer installieren
```
cd ~
test -d ~/bin || mkdir ~/bin  
curl -sS https://getcomposer.org/installer | php -- --install-dir=./bin --filename=composer  
```
* Clone git repo
```
cd /var/www/virtual/redev01/
git clone git@github.com:findingmarbles/Retromat.git retromat.git
```
* copy config template to active config
```
cd /var/www/virtual/redev01/retromat.git/
cp backend/app/config/parameters.yml.redev backend/app/config/parameters.yml
```
* edit copied config template ...
```
vim /var/www/virtual/redev01/retromat.git/backend/app/config/parameters.yml
```
... you need to update these values:
```
database_name: redev01_retromat
database_user: redev01
database_password: (siehe cat ~/.my.cnf )
redis_connection: (home dir, z.B. /home/redev01/.redis/sock )
```
* Install Libraries
```
cd /var/www/virtual/redev01/retromat.git/backend
composer install
```
* create database
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
Die ersten zwei nicht-Kommentar Zeilen (CREATE DATABASE ... USE ...)editieren, neuen DB Name ( redev01_retromat einsetzten)
* Editierten DB Dump einpspielen:
```
cd ~
cat retromat-dev.sql | mysql
cd /var/www/virtual/redev01/retromat.git/backend
bin/console doctrine:schema:validate
```
* Tempales aus index.php erstellen
```
cd /var/www/virtual/redev01/retromat.git/
backend/bin/travis-ci/generate-templates-from-retromat-v1.sh
```
* web directory per Symlink im Web sichtbar machen
```
cd /var/www/virtual/redev01
ln -s retromat.git/backend/web/ redev01.canopus.uberspace.de
```

Und nun ist er live erreichbar:
https://redev01.canopus.uberspace.de/