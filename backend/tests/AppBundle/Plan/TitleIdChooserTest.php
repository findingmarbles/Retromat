<?php
declare(strict_types=1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleIdChooser;
use Symfony\Component\Yaml\Yaml;

class TitleIdChooserTest extends \PHPUnit_Framework_TestCase
{
    public function testChooseTitleIdEmptyUnless5Activities()
    {
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
'
        );
        $chooser = new TitleIdChooser($titleParts);

        $this->assertEquals('', $chooser->chooseTitleId('1'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4-5-6'));
    }

    public function testChooseTitleIdCorrectFormat()
    {
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
'
        );
        $chooser = new TitleIdChooser($titleParts);

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

    public function testDifferentPlansGetDifferentTitles()
    {
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1, 2]
    1: [   1, 2]
    2: [0, 1   ]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
'
        );
        $chooser = new TitleIdChooser($titleParts);

        $titleId1 = $chooser->chooseTitleId('1-2-3-4-5');
        $titleId2 = $chooser->chooseTitleId('1-2-3-4-6');
        $this->assertNotEquals($titleId2, $titleId1);

        $titleId2 = $chooser->chooseTitleId('1-2-3-4-7');
        $this->assertNotEquals($titleId2, $titleId1);
    }
}
