<?php

namespace tests\AppBundle\Plan;

use AppBundle\Plan\PlanIdGenerator;

class PlanIdGeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $ids = [];

    public function testGenerateAll()
    {
        $planGenerator = new PlanIdGenerator();
        $activitiesByPhase = [
            0 => [1, 6],
            1 => [2, 7],
            2 => [3],
            3 => [4],
            4 => [5],
        ];

        $planGenerator->generateAll([$this, 'collect'], $activitiesByPhase);

        $this->assertEquals('1-2-3-4-5', $this->ids[0]);
        $this->assertEquals('6-2-3-4-5', $this->ids[1]);
        $this->assertEquals('1-7-3-4-5', $this->ids[2]);
        $this->assertEquals('6-7-3-4-5', $this->ids[3]);
    }

    public function collect($id)
    {
        $this->ids[] = $id;
    }
}
