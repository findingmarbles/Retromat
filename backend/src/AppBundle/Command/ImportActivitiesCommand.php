<?php
declare(strict_types=1);

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportActivitiesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('retromat:import:activities')

            // the short description shown while running "php bin/console list"
            ->setDescription('Import activities.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to import activities. Activities not yet existing in the DB are created, existing activities are updated.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Importing retromat activities from JS files into the database ...');

        $this->getContainer()->get('retromat.activity_importer')->import();

        $output->writeln('Import complete.');
    }
}