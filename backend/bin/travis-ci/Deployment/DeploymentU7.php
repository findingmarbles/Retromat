<?php
declare(strict_types=1);

/**
 * Higly specific for travis-ci + uberspace, because we hope to stay here for a couple of years :-)
 */
class DeploymentU7
{
    const BuildDirPrefix = 'travis-build/';
    const SshDestination = 'retro7@cyllene.uberspace.de';
    const WebSpaceDirPrefix = '/var/www/virtual/retro7/';

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
        $this->deploymentDomain = 'retro7.uber.space';
    }

    /**
     * The whole deployment workflow.
     */
    public function run()
    {
        $this->cleanupBuildDir();
        $this->createArtifact();
        $this->enableSshConnectionMultiplexing();
        $this->transferArtifact();

        $this->remoteUnpackArtifact();
        $this->remoteUpdateDatabase();
        $this->remoteCacheClearAndWarm();
        $this->remoteExpose();
    }

    private function cleanupBuildDir()
    {
        system('php backend/bin/console cache:clear --no-warmup --env=prod');
        system('mkdir backend/var/logs-travis-U7');
        system('mv backend/var/logs/* backend/var/logs-travis');
    }

    private function createArtifact()
    {
        system('rm -rf '.self::BuildDirPrefix.$this->buildDirName);
        system('mkdir -p '.self::BuildDirPrefix.$this->buildDirName);
        system('cp -rp * '.self::BuildDirPrefix.$this->buildDirName);
        system('chmod -R 755 '.self::BuildDirPrefix.$this->buildDirName);
        system('cd '.self::BuildDirPrefix.' ; tar cfz '.$this->artifactFileName.' '.$this->buildDirName);
    }

    private function enableSshConnectionMultiplexing()
    {
        file_put_contents(
            getenv('HOME').'/.ssh/config',
            "Host avior.uberspace.de\n\tStrictHostKeyChecking no\n\tControlMaster auto\n\tControlPath ~/.ssh/master-%r@%h:%p\n\tControlPersist 15\n",
            FILE_APPEND
        );
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

    private function remote($command)
    {
        system('ssh '.self::SshDestination.' "'.$command.' "');
    }

    private function remoteUnpackArtifact()
    {
        $this->remote('mkdir -p '.$this->deploymentDestinationDir);
        $this->remote(
            'cd '.$this->deploymentDestinationDir.' ; tar xfz '.$this->artifactDestinationDir.$this->artifactFileName
        );
    }

    private function remoteUpdateDatabase()
    {
        $this->remote('/home/retromat/bin_bin.git/dump_mysql.sh');
        $this->remote(
            'cd '.$this->deploymentDir.' ; php backend/bin/console doctrine:migrations:migrate --no-interaction'
        );
    }

    private function remoteCacheClearAndWarm()
    {
        $this->remote('cd '.$this->deploymentDir.' ; php backend/bin/console cache:clear --no-warmup --env=prod');
        $this->remote('redis-cli -s /home/retromat/.redis/sock FLUSHALL');
        $this->remote('cd '.$this->deploymentDir.' ; php backend/bin/console cache:warmup --env=prod');
    }

    private function remoteExpose()
    {
        // make backend/web of the current deployment domain directory visible to the outside
        $this->remote(
            'cd '.self::WebSpaceDirPrefix.' ; rm '.$this->deploymentDomain.' ; ln -s '.$this->deploymentDir.'/backend/web/ '.$this->deploymentDomain
        );
        $this->remote(
            'cd '.self::WebSpaceDirPrefix.' ; rm www.'.$this->deploymentDomain.' ; ln -s '.$this->deploymentDir.'/backend/web/ www.'.$this->deploymentDomain
        );

        // make backend/web of the previous deployment domain directory visible to the outside
        $this->remote(
            'cd '.self::WebSpaceDirPrefix.' ; rm plans-for-retrospectives.com ; ln -s '.$this->deploymentDir.'/backend/web/ plans-for-retrospectives.com'
        );
        $this->remote(
            'cd '.self::WebSpaceDirPrefix.' ; rm www.plans-for-retrospectives.com ; ln -s '.$this->deploymentDir.'/backend/web/ www.plans-for-retrospectives.com'
        );

        // mark the current deployment directory so we can reference it from the cron script that will periodically build the sitemap via the command line
        $this->remote(
            'cd '.$this->deploymentDestinationDir.' ; rm -f current ; ln -s '.$this->deploymentDir.' current'
        );

        // make the sitemap files availabe inside each new deployment directory
        $sitemapDir = self::WebSpaceDirPrefix.'retromat-sitemaps/';
        $this->remote('ln -s '.$sitemapDir.'/sitemap.* '.self::WebSpaceDirPrefix.$this->deploymentDomain.'/');

        // php-cgi caches php files beyond deployments, therefore kill it
        $this->remote('uberspace tools restart php');

        // ensure that php-cgi starts and caches to most needed php files right now
        system('curl -k https://'.$this->deploymentDomain.' -o /dev/null');
    }
}