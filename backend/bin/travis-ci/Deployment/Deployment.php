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
     * @var string
     */
    private $artifactDestinationDir;

    /**
     * @var string
     */
    private $deploymentDestinationDir;

    /**
     * @var string
     */
    private $deploymentDir;

    /**
     * @var string
     */
    private $deploymentDomain;

    /**
     * @param $TRAVIS_COMMIT
     */
    public function __construct($travisCommit)
    {
        system('echo '.$travisCommit.' > '.'backend/web/commit.txt');

        // local settings
        $this->buildDirName = date_format(date_create(), 'Y-m-d__H-i-s__').$travisCommit;
        $this->artifactFileName = $this->buildDirName.'.tar.gz ';

        // remote settings
        $this->artifactDestinationDir = self::WebSpaceDirPrefix.'retromat-artifacts/';
        $this->deploymentDestinationDir = self::WebSpaceDirPrefix.'retromat-deployments/';
        $this->deploymentDir = self::WebSpaceDirPrefix.'retromat-deployments/'.$this->buildDirName;
        $this->deploymentDomain = 'plans-for-retrospectives.com';
    }

    /**
     * The whole deployment workflow. Will probably brake this up into smaller functions later.
     */
    public function run()
    {
        $this->createArtifact();
        $this->enableSshConnectionMultiplexing();
        $this->transferArtifact();

        $this->remoteUnpackArtifact();
        $this->remoteUpdateDatabase();
        $this->remoteCacheClearAndWarm();
        $this->remoteExpose();
    }

    private function createArtifact()
    {
        system('mkdir -p '.self::BuildDirPrefix.$this->buildDirName);
        system('mv * '.self::BuildDirPrefix.$this->buildDirName);
        system('chmod -R 755 '.self::BuildDirPrefix.$this->buildDirName);
        system('cd '.self::BuildDirPrefix.' ; tar cfz '.$this->artifactFileName.' '.$this->buildDirName);
    }

    private function enableSshConnectionMultiplexing()
    {
        file_put_contents(getenv('HOME').'/.ssh/config', "Host avior.uberspace.de\n\tStrictHostKeyChecking no\n\tControlMaster auto\n\tControlPath ~/.ssh/master-%r@%h:%p\n\tControlPersist 15\n", FILE_APPEND);
    }

    private function transferArtifact()
    {
        system('ssh '.self::SshDestination.' mkdir -p '.$this->artifactDestinationDir);
        system(
            'rsync '.self::BuildDirPrefix.$this->artifactFileName.' '.self::SshDestination.':'.$this->artifactDestinationDir
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
        $command = 'ssh '.self::SshDestination.' "cd '.$this->artifactDestinationDir.' ; md5sum '.$this->artifactFileName.' "';
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
    }

    private function remoteUnpackArtifact()
    {
        system('ssh '.self::SshDestination.' mkdir -p '.$this->deploymentDestinationDir);
        system(
            'ssh '.self::SshDestination.' "cd '.$this->deploymentDestinationDir.' ; tar xfz '.$this->artifactDestinationDir.$this->artifactFileName.' "'
        );
    }

    private function remoteUpdateDatabase()
    {
        // force update schema and load fixtures (as long as DB is readonly, this will be O.K.)
        system(
            'ssh '.self::SshDestination.' "cd '.$this->deploymentDir.' ; php backend/bin/console doctrine:schema:update --force --env=dev "'
        );
        system(
            'ssh '.self::SshDestination.' "cd '.$this->deploymentDir.' ; php backend/bin/console doctrine:fixtures:load -n --env=dev "'
        );
    }

    private function remoteCacheClearAndWarm()
    {
        system(
            'ssh '.self::SshDestination.' "cd '.$this->deploymentDir.' ; php backend/bin/console cache:clear --env=prod "'
        );
    }

    private function remoteExpose()
    {
// make backend/web of the current deployment directory visible to the outside
        system(
            'ssh '.self::SshDestination.' "cd '.self::WebSpaceDirPrefix.' ; rm '.$this->deploymentDomain.' ; ln -s '.$this->deploymentDir.'/backend/web/ '.$this->deploymentDomain.' "'
        );
        system(
            'ssh '.self::SshDestination.' "cd '.self::WebSpaceDirPrefix.' ; rm www.'.$this->deploymentDomain.' ; ln -s '.$this->deploymentDir.'/backend/web/ www.'.$this->deploymentDomain.' "'
        );

        // mark the current deployment directory so we can reference it from the cron script that will periodically build the sitemap via the command line
        system(
            'ssh '.self::SshDestination.' "cd '.$this->deploymentDestinationDir.' ; rm -f current ; ln -s '.$this->deploymentDir.' current "'
        );

        // make the sitemap files availabe inside each new deployment directory
        $sitemapDir = self::WebSpaceDirPrefix.'retromat-sitemaps/';
        system(
            'ssh '.self::SshDestination.' "ln -s '.$sitemapDir.'/sitemap.* '.self::WebSpaceDirPrefix.$this->deploymentDomain.'/ "'
        );

        // php-cgi caches php files beyond deployments, therefore kill it
        system('ssh '.self::SshDestination.' killall php-cgi ');

        // ensure that php-cgi starts and caches to most needed php files right now
        system('curl -k https://'.$this->deploymentDomain.' -o /dev/null');
    }
}