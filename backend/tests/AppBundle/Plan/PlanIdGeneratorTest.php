<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\PlanIdGenerator;
use AppBundle\Activity\ActivityByPhase;

class PlanIdGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $ids = [];

    /**
     * @var PlanIdGenerator
     */
    private $planIdGenerator;

    public function setUp()
    {
        $this->ids = [];

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
        $this->planIdGenerator = new PlanIdGenerator($activitiyByPhase);
    }

    public function testGenerateAll()
    {
        $this->planIdGenerator->generate([$this, 'collect']);

        $this->assertEquals('1-2-3-4-5', $this->ids[0]);
        $this->assertEquals('6-2-3-4-5', $this->ids[1]);
        $this->assertEquals('1-7-3-4-5', $this->ids[2]);
        $this->assertEquals('6-7-3-4-5', $this->ids[3]);
    }

    public function testGenerateLimit()
    {
        $limit = 2;

        $this->planIdGenerator->generate([$this, 'collect'], $limit);

        $this->assertCount($limit, $this->ids);
        $this->assertEquals('1-2-3-4-5', $this->ids[0]);
        $this->assertEquals('6-2-3-4-5', $this->ids[1]);
    }

    /**
     * @param string $id
     */
    public function collect(string $id)
    {
        $this->ids[] = $id;
    }
}
