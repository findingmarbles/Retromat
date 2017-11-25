<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Entity\Activity2;
use AppBundle\Plan\DescriptionRenderer;

class DescriptionRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderEmptyDescriptionUnless5Activities()
    {
        $renderer = new DescriptionRenderer();

        $activities = [];
        $this->assertEmpty($renderer->render($activities));

        $activities[] = new Activity2();
        $activities[] = new Activity2();
        $activities[] = new Activity2();
        $activities[] = new Activity2();
        $this->assertEmpty($renderer->render($activities));

        $activities[] = new Activity2();
        $activities[] = new Activity2();
        $this->assertEmpty($renderer->render($activities));
    }

    public function testRender()
    {
        $renderer = new DescriptionRenderer();

        $activities[0] = (new Activity2())->setRetromatId(1);

        $activity1 = new Activity2();
        $activity1->setRetromatId(4)->setSummary(
            'Participants write down significant events and order them chronologically'
        );
        $activities[1] = $activity1;

        $activity2 = new Activity2();
        $activity2->setRetromatId(8)->setSummary(
            'Drill down to the root cause of problems by repeatedly asking \'Why?\''
        );
        $activities[2] = $activity2;

        $activities[3] = (new Activity2())->setRetromatId(11);

        $activities[4] = (new Activity2())->setRetromatId(14);

        $this->assertEquals(
            '1, 4: Participants write down significant events and order them chronologically, 8: Drill down to the root cause of problems by repeatedly asking \'Why?\', 11, 14',
            $renderer->render($activities)
        );
    }
}
