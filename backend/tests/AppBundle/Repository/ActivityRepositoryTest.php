<?php

namespace tests\AppBundle\Repository;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class ActivityRepositoryTest extends WebTestCase
{
    public function testFindOrdered()
    {
        $repo = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        $ordered = $repo->findOrdered($language = 'en', $id = [3, 87, 113, 13, 16]);

        // check for correct keys
        $this->assertEquals(3, $ordered[0]->getRetromatId());
        $this->assertEquals(87, $ordered[1]->getRetromatId());
        $this->assertEquals(113, $ordered[2]->getRetromatId());
        $this->assertEquals(13, $ordered[3]->getRetromatId());
        $this->assertEquals(16, $ordered[4]->getRetromatId());

        // check for correct order of keys
        $this->assertEquals(3, reset($ordered)->getRetromatId());
        $this->assertEquals(87, next($ordered)->getRetromatId());
        $this->assertEquals(113, next($ordered)->getRetromatId());
        $this->assertEquals(13, next($ordered)->getRetromatId());
        $this->assertEquals(16, end($ordered)->getRetromatId());
    }
}
