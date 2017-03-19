<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Entity\Activity;
use AppBundle\Plan\DescriptionRenderer;

class DescriptionRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $renderer = new DescriptionRenderer();

        $activities[] = new Activity();
        $activities[] = new Activity();
        $activities[] = new Activity();
        $activities[] = new Activity();
        $activities[] = new Activity();

        $this->assertEquals('1, 4: Participants write down significant events and order them chronologically , 8: Drill down to the root cause of problems by repeatedly asking \'Why?\', 11, 14', $renderer->render($activities));
    }

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
}
