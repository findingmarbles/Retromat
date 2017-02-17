<?php

/**
 * Higly specific for travis-ci + uberspace, because we hope to stay here for a couple of years :-)
 */
class Deployment
{
    const BuildDirPrefix = 'travis-build/';
    const SshDestination = 'retromat@avior.uberspace.de';
    const WebSpaceDirPrefix = '/var/www/virtual/retromat/';

    /**
     * @var string
     */
    private $buildDirName;

    /**
     * @var string
     */
    private $artifactFileName;

    /**
     * @param $TRAVIS_COMMIT
     */
    public function __construct($travisCommit)
    {
        system('echo '.$travisCommit.' > '.'backend/web/commit.txt');

        // local settings
        $this->buildDirName = date_format(date_create(), 'Y-m-d__H-i-s__').$travisCommit;
        $this->artifactFileName = $this->buildDirName.'.tar.gz ';
    }

    /**
     * The whole deployment workflow. Will probably brake this up into smaller functions later.
     */
    public function run()
    {
        $this->enableSshConnectionMultiplexing();

        // remote settings
        $artifactDestinationDir = self::WebSpaceDirPrefix.'retromat-artifacts/';
        $deploymentDestinationDir = self::WebSpaceDirPrefix.'retromat-deployments/';
        $sitemapDir = self::WebSpaceDirPrefix.'retromat-sitemaps/';
        $deploymentDir = self::WebSpaceDirPrefix.'retromat-deployments/'.$this->buildDirName;
        $deploymentDomain = 'plans-for-retrospectives.com';

        // create artifact
        system('mkdir -p '.self::BuildDirPrefix.$this->buildDirName);
        system('mv * '.self::BuildDirPrefix.$this->buildDirName);
        system('chmod -R 755 '.self::BuildDirPrefix.$this->buildDirName);
        system('cd '.self::BuildDirPrefix.' ; tar cfz '.$this->artifactFileName.' '.$this->buildDirName);

        // transfer artifact
        system('ssh '.self::SshDestination.' mkdir -p '.$artifactDestinationDir);
        system(
            'rsync '.self::BuildDirPrefix.$this->artifactFileName.' '.self::SshDestination.':'.$artifactDestinationDir
        );

        // obtain local md5
        $output = array();
        $exitCode = '';
        $command = 'cd '.self::BuildDirPrefix.' ; md5sum '.$this->artifactFileName;
        exec($command, $output, $exitCode);
        if (0 === $exitCode) {
            $md5Local = $output[0];
        } else {
            exit(1);
        }

        // obtain remote md5
        $output = array();
        $exitCode = '';
        $command = 'ssh '.self::SshDestination.' "cd '.$artifactDestinationDir.' ; md5sum '.$this->artifactFileName.' "';
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
        system('ssh '.self::SshDestination.' mkdir -p '.$deploymentDestinationDir);
        system(
            'ssh '.self::SshDestination.' "cd '.$deploymentDestinationDir.' ; tar xfz '.$artifactDestinationDir.$this->artifactFileName.' "'
        );

        // update DB schema and load fixtures (as long as DB is readonly, this will be O.K.)
        system(
            'ssh '.self::SshDestination.' "cd '.$deploymentDir.' ; php backend/bin/console doctrine:schema:update --force --env=dev "'
        );
        system(
            'ssh '.self::SshDestination.' "cd '.$deploymentDir.' ; php backend/bin/console doctrine:fixtures:load -n --env=dev "'
        );

        // clear and prefill production cache
        system(
            'ssh '.self::SshDestination.' "cd '.$deploymentDir.' ; php backend/bin/console cache:clear --env=prod "'
        );

        // make backend/web of the current deployment directory visible to the outside
        system(
            'ssh '.self::SshDestination.' "cd '.self::WebSpaceDirPrefix.' ; rm '.$deploymentDomain.' ; ln -s '.$deploymentDir.'/backend/web/ '.$deploymentDomain.' "'
        );
        system(
            'ssh '.self::SshDestination.' "cd '.self::WebSpaceDirPrefix.' ; rm www.'.$deploymentDomain.' ; ln -s '.$deploymentDir.'/backend/web/ www.'.$deploymentDomain.' "'
        );

        // mark the current deployment directory so we can reference it from the cron script that will periodically build the sitemap via the command line
        system(
            'ssh '.self::SshDestination.' "cd '.$deploymentDestinationDir.' ; rm -f current ; ln -s '.$deploymentDir.' current "'
        );

        // make the sitemap files availabe inside each new deployment directory
        system(
            'ssh '.self::SshDestination.' "ln -s '.$sitemapDir.'/sitemap.* '.self::WebSpaceDirPrefix.$deploymentDomain.'/ "'
        );

        // php-cgi caches php files beyond deployments, therefore kill it
        system('ssh '.self::SshDestination.' killall php-cgi ');

        // ensure that php-cgi starts and caches to most needed php files right now
        system('curl -k https://'.$deploymentDomain.' -o /dev/null');
    }

    private function enableSshConnectionMultiplexing()
    {
        $config = "
Host avior.uberspace.de
\tStrictHostKeyChecking no
\tControlMaster auto
\tControlPath ~/.ssh/master-%r@%h:%p
\tControlPersist 15
";

        file_put_contents(getenv('HOME').'/.ssh/config', $config, FILE_APPEND);
    }
}