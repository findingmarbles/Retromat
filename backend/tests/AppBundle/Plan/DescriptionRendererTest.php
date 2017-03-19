<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\DescriptionRenderer;

class DescriptionRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $renderer = new DescriptionRenderer();

        $this->assertEquals('1, 4: Participants write down significant events and order them chronologically , 8: Drill down to the root cause of problems by repeatedly asking \'Why?\', 11, 14', $renderer->render());
    }
}
