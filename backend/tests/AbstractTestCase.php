<?php

namespace App\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class AbstractTestCase extends WebTestCase
{
    public function loadFixtures($fixtures)
    {
        return $this->getContainer()
            ->get(DatabaseToolCollection::class)
            ->get()
            ->loadFixtures($fixtures);
    }

    /**
     * @return KernelBrowser
     */
    protected function getKernelBrowser(): KernelBrowser
    {
        if (static::$booted) {
            static::ensureKernelShutdown();
        }

        return static::createClient(['debug' => false]);
    }
}
