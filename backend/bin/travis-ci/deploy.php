<?php

// arguments
$TRAVIS_COMMIT = $argv[1];

// local settings
$buildDirPrefix = 'travis-build/';
$buildDirName = date_format(date_create(), 'Y-m-d__H-i-s__').$TRAVIS_COMMIT;
$artifactFileName = $buildDirName.'.tar.gz ';

// remote settings
$sshDestination = 'retromat@avior.uberspace.de';
$webSpaceDirPrefix = '/var/www/virtual/retromat/';
$artifactDestinationDir = $webSpaceDirPrefix.'retromat-artifacts/';
$deploymentDestinationDir = $webSpaceDirPrefix.'retromat-deployments/';
$deploymentDir = $webSpaceDirPrefix.'retromat-deployments/'.$buildDirName;
$deploymentDomain = 'plans-for-retrospectives.com';

// mark deployment
system('echo '.$TRAVIS_COMMIT .' > '.'backend/web/commit.txt');

// create artifact
system('mkdir -p '.$buildDirPrefix.$buildDirName);
system('mv * '.$buildDirPrefix.$buildDirName);
system('chmod -R 755 '.$buildDirPrefix.$buildDirName);
system('cd '.$buildDirPrefix.' ; tar cfz '.$artifactFileName.' '.$buildDirName);

// transfer artifact
system('ssh '.$sshDestination.' mkdir -p '.$artifactDestinationDir);
system('rsync '.$buildDirPrefix.$artifactFileName.' '.$sshDestination.':'.$artifactDestinationDir);

// obtain local md5
$output = array();
$exitCode = '';
$command = 'cd '.$buildDirPrefix.' ; md5sum '.$artifactFileName;
exec($command, $output, $exitCode);
if (0 === $exitCode) {
    $md5Local = $output[0];
} else {
    exit(1);
}

// obtain remote md5
$output = array();
$exitCode = '';
$command = 'ssh '.$sshDestination.' "cd '.$artifactDestinationDir.' ; md5sum '.$artifactFileName.' "';
exec($command, $output, $exitCode);
if (0 === $exitCode) {
    $md5Remote = $output[0];
} else {
    exit(2);
}

// notify about success
echo PHP_EOL.'Local md5:  '.$md5Local.PHP_EOL.'Remote md5: '.$md5Remote;
if (0 !== strcmp($md5Local, $md5Remote)) {
    exit(3);
}

// unpack artifact
system('ssh '.$sshDestination.' mkdir -p '.$deploymentDestinationDir);
system('ssh '.$sshDestination.' "cd '.$deploymentDestinationDir . ' ; tar xfz ' . $artifactDestinationDir.$artifactFileName . ' "');

// update DB schema and load fixtures (as long as DB is readonly, this will be O.K.)
system('ssh '.$sshDestination.' "cd '.$deploymentDir.' ; php backend/bin/console doctrine:schema:update --force --env=dev "');
system('ssh '.$sshDestination.' "cd '.$deploymentDir.' ; php backend/bin/console doctrine:fixtures:load -n --env=dev "');

// clear and prefill production cache
system('ssh '.$sshDestination.' "cd '.$deploymentDir.' ; php backend/bin/console cache:clear --env=prod "');

// make backend/web of the current deployment directory visible to the outside
system('ssh '.$sshDestination.' "cd '.$webSpaceDirPrefix.' ; rm '.$deploymentDomain.' ; ln -s '.$deploymentDir.'/backend/web/ '.$deploymentDomain.' "');
system('ssh '.$sshDestination.' "cd '.$webSpaceDirPrefix.' ; rm www.'.$deploymentDomain.' ; ln -s '.$deploymentDir.'/backend/web/ www.'.$deploymentDomain.' "');

// mark the current deployment directory so we can reference it from the cron script that will periodically build the sitemap via the command line
system('ssh '.$sshDestination.' "cd '.$deploymentDestinationDir.' ; rm -f current ; ln -s '.$deploymentDir.' current "');

// php-cgi caches php files beyond deployments, therefore kill it
system('ssh '.$sshDestination.' killall php-cgi ');

// ensure that php-cgi starts and caches to most needed php files right now
system('curl -k https://'.$deploymentDomain.' -o /dev/null');
