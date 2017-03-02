<?php

namespace tests\AppBundle\Plan;

use AppBundle\Activity\ActivityByPhase;
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
        $activitiesByPhase = [
            0 => [1, 6],
            1 => [2, 7],
            2 => [3],
            3 => [4],
            4 => [5],
        ];
        $activitiyByPhase = $this
            ->getMockBuilder(ActivityByPhase::class)
            ->setMethods(['getAllActivitiesByPhase'])
            ->disableOriginalConstructor()
            ->getMock();
        $activitiyByPhase->expects($this->any())
            ->method('getAllActivitiesByPhase')
            ->will($this->returnValue($activitiesByPhase));


        $planIdGenerator = new PlanIdGenerator($activitiyByPhase);
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $repo = $entityManager->getRepository('AppBundle:Plan');
        $planGenerator = new PlanGenerator($planIdGenerator, $entityManager);

        $planGenerator->generateAll();

        $this->assertCount(4, $entityManager->getRepository('AppBundle:Plan')->findAll());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '1-2-3-4-5'])->getTitleId());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '6-2-3-4-5'])->getTitleId());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '1-7-3-4-5'])->getTitleId());
        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $repo->findOneBy(['retromatId' => '6-7-3-4-5'])->getTitleId());
    }
}
