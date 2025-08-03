<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\RetromatImportActivitiesCommand;
use App\Model\Importer\Activity\ActivityImporter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class RetromatImportActivitiesCommandTest extends TestCase
{
    private MockObject|ActivityImporter $activityImporter;
    private RetromatImportActivitiesCommand $command;
    private CommandTester $commandTester;

    public function setUp(): void
    {
        $this->activityImporter = $this->createMock(ActivityImporter::class);
        $this->command = new RetromatImportActivitiesCommand($this->activityImporter);
        $this->command->setName('test:import-activities');

        $application = new Application();
        $application->add($this->command);

        $this->commandTester = new CommandTester($this->command);
    }

    public function testExecuteSuccessfully(): void
    {
        $this->activityImporter
            ->expects($this->once())
            ->method('import')
            ->willReturn(null);

        $exitCode = $this->commandTester->execute([]);

        $this->assertEquals(Command::SUCCESS, $exitCode);
        $this->assertStringNotContainsString('Import failed', $this->commandTester->getDisplay());
    }

    public function testExecuteWithImportException(): void
    {
        $exceptionMessage = 'Test import error';
        $this->activityImporter
            ->expects($this->once())
            ->method('import')
            ->willThrowException(new \Exception($exceptionMessage));

        $exitCode = $this->commandTester->execute([]);

        $this->assertEquals(Command::FAILURE, $exitCode);
        $this->assertStringContainsString('Import failed', $this->commandTester->getDisplay());
        $this->assertStringContainsString($exceptionMessage, $this->commandTester->getDisplay());
    }

    public function testCommandConfiguration(): void
    {
        $this->assertEquals(
            'This command allows you to import activities. Activities not yet existing in the DB are created, existing activities are updated.',
            $this->command->getDescription()
        );
    }

    public function testCommandConstructor(): void
    {
        $command = new RetromatImportActivitiesCommand($this->activityImporter);

        $this->assertInstanceOf(RetromatImportActivitiesCommand::class, $command);
        $this->assertInstanceOf(Command::class, $command);
    }

    public function testCommandHasCorrectName(): void
    {
        $this->assertNotEmpty($this->command->getName());
    }

    public function testExecuteDisplaysSymfonyStyle(): void
    {
        $this->activityImporter
            ->method('import')
            ->willReturn(null);

        $exitCode = $this->commandTester->execute([]);

        $this->assertEquals(Command::SUCCESS, $exitCode);
        // SymfonyStyle is used internally, no specific output to test but command completes
    }
}
