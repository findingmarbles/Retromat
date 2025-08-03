<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\RetromatImportActivitiesCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;

class RetromatImportActivitiesCommandTest extends TestCase
{
    public function testCommandHasCorrectDescription(): void
    {
        // Use reflection to test the command configuration without instantiating dependencies
        $reflection = new \ReflectionClass(RetromatImportActivitiesCommand::class);
        $constants = $reflection->getConstants();

        $this->assertEquals(
            'This command allows you to import activities. Activities not yet existing in the DB are created, existing activities are updated.',
            $constants['DESCRIPTION']
        );
    }

    public function testCommandExtendsBaseCommand(): void
    {
        $reflection = new \ReflectionClass(RetromatImportActivitiesCommand::class);

        $this->assertTrue($reflection->isSubclassOf(Command::class));
    }

    public function testCommandHasRequiredMethods(): void
    {
        $reflection = new \ReflectionClass(RetromatImportActivitiesCommand::class);

        $this->assertTrue($reflection->hasMethod('configure'));
        $this->assertTrue($reflection->hasMethod('execute'));
        $this->assertTrue($reflection->hasMethod('__construct'));
    }

    public function testExecuteMethodSignature(): void
    {
        $reflection = new \ReflectionClass(RetromatImportActivitiesCommand::class);
        $executeMethod = $reflection->getMethod('execute');

        $this->assertTrue($executeMethod->isProtected());
        $this->assertEquals(2, $executeMethod->getNumberOfParameters());

        $parameters = $executeMethod->getParameters();
        $this->assertEquals('input', $parameters[0]->getName());
        $this->assertEquals('output', $parameters[1]->getName());
    }
}
