<?php
declare(strict_types = 1);

namespace App\Tests\Plan;

use App\Entity\Activity;
use App\Model\Plan\DescriptionRenderer;

class DescriptionRendererTest extends \PHPUnit\Framework\TestCase
{
    public function testRenderEmptyDescriptionUnless5Activities()
    {
        $renderer = new DescriptionRenderer();

        $activities = [];
        $this->assertEmpty($renderer->render($activities));

        $activities[] = new Activity();
        $activities[] = new Activity();
        $activities[] = new Activity();
        $activities[] = new Activity();
        $this->assertEmpty($renderer->render($activities));

        $activities[] = new Activity();
        $activities[] = new Activity();
        $this->assertEmpty($renderer->render($activities));
    }

    public function testRender()
    {
        $renderer = new DescriptionRenderer();

        $activities[0] = (new Activity())->setRetromatId(1);

        $activity1 = new Activity();
        $activity1->setRetromatId(4)->setSummary(
            'Participants write down significant events and order them chronologically'
        );
        $activities[1] = $activity1;

        $activity2 = new Activity();
        $activity2->setRetromatId(8)->setSummary(
            'Drill down to the root cause of problems by repeatedly asking \'Why?\''
        );
        $activities[2] = $activity2;

        $activities[3] = (new Activity())->setRetromatId(11);

        $activities[4] = (new Activity())->setRetromatId(14);

        $this->assertEquals(
            '1, 4: Participants write down significant events and order them chronologically, 8: Drill down to the root cause of problems by repeatedly asking \'Why?\', 11, 14',
            $renderer->render($activities)
        );
    }
}
