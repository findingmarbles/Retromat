<?php
declare(strict_types=1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleIdChooser;

class TitleIdChooserTest extends \PHPUnit_Framework_TestCase
{
    public function testChooseTitleIdEmptyUnless5Activities()
    {
        $chooser = new TitleIdChooser();

        $this->assertEquals('', $chooser->chooseTitleId('1'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4-5-6'));
    }

    public function testChooseTitleIdCorrectFormat()
    {
        $chooser = new TitleIdChooser();

        $titleId = $chooser->chooseTitleId('1-2-3-4-5');

        $idStringParts = explode(':', $titleId);
        $sequenceId = $idStringParts[0];
        $this->assertTrue(is_numeric($sequenceId));

        $fragmentIdsString = $idStringParts[1];
        $this->assertContains('-', $fragmentIdsString);

        $fragmentIds = explode('-', $fragmentIdsString);
        $this->assertInternalType('array', $fragmentIds);

        foreach ($fragmentIds as $fragmentId) {
            $this->assertTrue(is_numeric($fragmentId));
        }
    }
}
