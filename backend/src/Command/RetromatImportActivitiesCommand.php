<?php

namespace App\Command;

use App\Model\Importer\Activity\ActivityImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RetromatImportActivitiesCommand extends Command
{
    private const DESCRIPTION = 'This command allows you to import activities. Activities not yet existing in the DB are created, existing activities are updated.';

    private ActivityImporter $activityImporter;

    public function __construct(ActivityImporter $activityImporter)
    {
        parent::__construct();

        $this->activityImporter = $activityImporter;
    }

    protected function configure(): void
    {
        $this->setDescription(self::DESCRIPTION);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->activityImporter->import();
        } catch (\Exception $exception) {
            $io->error(sprintf('Import failed: "%s"', $exception->getMessage()));
            return 1;
        }

        return 0;
    }
}
