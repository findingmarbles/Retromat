<?php
declare(strict_types=1);

namespace tests\AppBundle\Repository;

// tests directory is not available to the autoloader, so we have to manually require these files:
require_once 'DataFixtures/LoadActivityData.php';
require_once 'DataFixtures/LoadActivityDataForTestFindAllActivitiesForPhases.php';

use Liip\FunctionalTestBundle\Test\WebTestCase;

class Activity2RepositoryTest extends WebTestCase
{
    public function testFindAllOrdered()
    {
        $this->loadFixtures(['tests\AppBundle\Repository\DataFixtures\LoadActivityData']);

        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2');
        $ordered = $repo->findAllOrdered();

        // check for correct keys
        $this->assertEquals(1, $ordered[0]->getRetromatId());
        $this->assertEquals(2, $ordered[1]->getRetromatId());
        $this->assertEquals(3, $ordered[2]->getRetromatId());

        // check for correct order of keys
        $this->assertEquals(1, reset($ordered)->getRetromatId());
        $this->assertEquals(2, next($ordered)->getRetromatId());
        $this->assertEquals(3, next($ordered)->getRetromatId());
    }
}
