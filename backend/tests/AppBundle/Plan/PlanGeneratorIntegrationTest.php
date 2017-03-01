<?php

namespace tests\AppBundle\Plan;

use AppBundle\Entity\Plan;
use AppBundle\Plan\PlanGenerator;
use AppBundle\Plan\PlanIdGenerator;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Doctrine\Common\Persistence\ObjectManager;

class PlanGeneratorIntegrationTest extends WebTestCase
{
    public function testGenerateAll()
    {
        $this->loadFixtures([]);
        $planIdGenerator = new PlanIdGenerator();
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $repo = $entityManager->getRepository('AppBundle:Plan');
        $planGenerator = new PlanGenerator($planIdGenerator, $entityManager);
        $activitiesByPhase = [
            0 => [1, 6],
            1 => [2, 7],
            2 => [3],
            3 => [4],
            4 => [5],
        ];

        $planGenerator->generateAll($activitiesByPhase);

        $this->assertCount(4, $entityManager->getRepository('AppBundle:Plan')->findAll());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '1-2-3-4-5'])->getTitleId());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '6-2-3-4-5'])->getTitleId());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '1-7-3-4-5'])->getTitleId());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '6-7-3-4-5'])->getTitleId());
    }
}
