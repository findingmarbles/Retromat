<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleIdChooser;
use AppBundle\Twig\Title;
use Symfony\Component\Yaml\Yaml;

class TitleIdChooserIntegrationTest extends \PHPUnit_Framework_TestCase
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

    public function testChooseTitleIdDifferentPlansGetDifferentTitles()
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

    public function testChooseTitleIdPlanAlwaysGetsSameTitle()
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

        // if it works 100 times in a row, we believe it always works
        for ($i = 0; $i < 100; $i++) {
            $titleId2 = $chooser->chooseTitleId('1-2-3-4-5');
            $this->assertEquals($titleId2, $titleId1);
        }
    }

    public function testChooseTitleIdMaxLength()
    {
        $this->markTestSkipped();
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: ["", "Agile", "Scrum", "Kanban", "XP"]
    1: ["", "Retro", "Retrospective"]
    2: ["Plan", "Agenda"]
'
        );
        $maxLengthIncludingPlanId = 14;
        $chooser = new TitleIdChooser($titleParts);
        $title = new Title($titleParts);

        $planId = '1-2-3-4-5';
        $titleId = $chooser->chooseTitleId($planId);
        $titleString = $title->render($titleId);
        $fullTitle = $titleString.' '.$planId;

        $this->assertLessThanOrEqual(
            $maxLengthIncludingPlanId,
            strlen($fullTitle),
            'This is longer than '.$maxLengthIncludingPlanId.': '.$fullTitle
        );
    }

    public function testIsShortEnough()
    {
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: ["", "Agile", "Scrum", "Kanban", "XP"]
    1: ["", "Retro", "Retrospective"]
    2: ["Plan", "Agenda"]
'
        );
        $maxLengthIncludingPlanId = 14;
        $title = new Title($titleParts);
        $chooser = new TitleIdChooser($titleParts, $title, $maxLengthIncludingPlanId);
        $planId = '1-2-3-4-5';

        $this->assertFalse($chooser->isShortEnough('0:1-1-1', $planId));
        $this->assertTrue($chooser->isShortEnough('0:0-0-0', $planId));
    }
}
