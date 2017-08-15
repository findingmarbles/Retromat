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
            ->setHelp(
                'This command allows you to import activities. Activities not yet existing in the DB are created, existing activities are updated.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Importing retromat activities from JS files into the database ...');

        // @todo Debug import of fr and ru activity files, then activate import of all languages:
        // $activityfilenames = $this->getContainer()->getParameter('activityfilenames');
        // foreach ($activityfilenames as $locale => $fileName) {

        // Now whitelisting files that can be imported without errors immediately:
        // foreach (['de', 'en', 'es', 'nl'] as $locale) {
        //    $this->getContainer()->get('retromat.activity_importer')->import($locale);
        //    $output->writeln('Imported '.$locale);
        // }

        // Whitelist only Enlish for now, other languages need further analysis.
        $this->getContainer()->get('retromat.activity_importer')->import('en');

        $output->writeln('Import complete.');
    }
}