<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SitemapCreateCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('retromat:sitemap:create')
            // the short description shown while running "php bin/console list"
            ->setDescription('Please use the presta:sitemaps:dump command for creating the sitemap.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Please use the presta:sitemaps:dump command for creating the sitemap.');
    }
}