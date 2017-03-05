<?php
declare(strict_types=1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleIdChooser;

class TitleIdChooserTest extends \PHPUnit_Framework_TestCase
{
    public function testChooseTitleIdReturnsEmptyStringUnless5Activities()
    {
        $chooser = new TitleIdChooser();

        $this->assertEquals('', $chooser->chooseTitleId('1'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4-5-6'));
    }
}
