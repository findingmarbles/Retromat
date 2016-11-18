<?php

// arguments
$TRAVIS_COMMIT = $argv[1];

// local settings
$buildDirPrefix = 'travis-build/';
$buildDir = $buildDirPrefix.$TRAVIS_COMMIT;
$artifactFileName = $TRAVIS_COMMIT.'.tar.gz ';

// remote setting
$sshDestination = 'timon@vega.uberspace.de';
$webSpaceDirPrefix = '/var/www/virtual/timon/';
$artifactDestinationDir = $webSpaceDirPrefix.'travis-ci-artifacts/';

// locally create artifact
system('mkdir -p '.$buildDir);
system('mv * '.$buildDir);
system('tar cfz '.$artifactFileName.' '.$buildDir);

// transfer artifact
system('ssh '.$sshDestination.' mkdir -p '.$artifactDestinationDir);
system('rsync '.$artifactFileName.' '.$sshDestination.':'.$artifactDestinationDir);
$remoteMd5sum = system('ssh '.$sshDestination.' md5sum '.$artifactDestinationDir.$artifactFileName);

echo $remoteMd5sum;

// compare md5sum local vs md5sum remote
