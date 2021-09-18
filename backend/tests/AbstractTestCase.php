<?php

namespace App\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class AbstractTestCase extends WebTestCase
{
    public function loadFixtures($fixtures): void
    {
        $this->getContainer()
            ->get(DatabaseToolCollection::class)
            ->get()
            ->loadFixtures($fixtures);
    }
}
