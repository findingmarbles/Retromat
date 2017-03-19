<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Entity\Activity;
use AppBundle\Plan\DescriptionRenderer;

class DescriptionRendererTest extends \PHPUnit_Framework_TestCase
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

        $activities[] = (new Activity())->setRetromatId(1);
        $activities[] = (new Activity())->setRetromatId(4)->setSummary('Participants write down significant events and order them chronologically');
        $activities[] = (new Activity())->setRetromatId(8)->setSummary('Drill down to the root cause of problems by repeatedly asking \'Why?\'');
        $activities[] = (new Activity())->setRetromatId(11);
        $activities[] = (new Activity())->setRetromatId(14);

        $this->assertEquals(
            '1, 4: Participants write down significant events and order them chronologically, 8: Drill down to the root cause of problems by repeatedly asking \'Why?\', 11, 14',
            $renderer->render($activities)
        );
    }
}
