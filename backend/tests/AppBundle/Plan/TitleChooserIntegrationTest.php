<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleChooser;
use AppBundle\Plan\TitleRenderer;
use Symfony\Component\Yaml\Yaml;

class TitleChooserIntegrationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderTitleSingleChoice()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retro]
    2: [Plan]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $titleRenderer = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $titleRenderer);

        $this->assertEquals('Agile Retro Plan: 1-2-3-4-5', $chooser->renderTitle('1-2-3-4-5'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderTitleSingleChoiceDe()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retro]
    2: [Plan]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $titleRenderer = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $titleRenderer);

        $this->assertEquals('Agiler Retro Plan: 1-2-3-4-5', $chooser->renderTitle('1-2-3-4-5', 'de'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderTitleEmptyUnless5Activities()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retro]
    2: [Plan]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $this->assertEquals('', $chooser->renderTitle('1-2-3-4'));
        $this->assertEquals('', $chooser->renderTitle('1-2-3-4-5-6'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderTitleEmptyUnless5ActivitiesDe()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retro]
    2: [Plan]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $this->assertEquals('', $chooser->renderTitle('1-2-3-4', 'de'));
        $this->assertEquals('', $chooser->renderTitle('1-2-3-4-5-6', 'de'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testChooseTitleIdEmptyUnless5Activities()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $this->assertEquals('', $chooser->chooseTitleId('1'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4-5-6'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testChooseTitleIdEmptyUnless5ActivitiesDe()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $this->assertEquals('', $chooser->chooseTitleId('1', 'de'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4', 'de'));
        $this->assertEquals('', $chooser->chooseTitleId('1-2-3-4-5-6', 'de'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testChooseTitleIdCorrectFormat()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

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

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testChooseTitleIdCorrectFormatDe()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
    
de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler]
        1: [Retro]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $titleId = $chooser->chooseTitleId('1-2-3-4-5', 'de');

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

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testChooseTitleIdDifferentPlansGetDifferentTitles()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]
    1: [   1, 2]
    2: [0, 1   ]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]

de:
    sequence_of_groups:
        0: [0, 1, 2]
        1: [   1, 2]
        2: [0, 1   ]
    
    groups_of_terms:
        0: [Agiler, Scrum, Kanban, XP]
        1: [Retro, Retrospective]
        2: [Plan, Ablaufplan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $titleId1 = $chooser->chooseTitleId('1-2-3-4-5');
        $titleId2 = $chooser->chooseTitleId('1-2-3-4-6');
        $this->assertNotEquals($titleId2, $titleId1);

        $titleId2 = $chooser->chooseTitleId('1-2-3-4-7');
        $this->assertNotEquals($titleId2, $titleId1);
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testChooseTitleIdDifferentPlansGetDifferentTitlesDe()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]
    1: [   1, 2]
    2: [0, 1   ]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]

de:
    sequence_of_groups:
        0: [0, 1, 2]
        1: [   1, 2]
        2: [0, 1   ]
    
    groups_of_terms:
        0: [Agiler, Scrum, Kanban, XP]
        1: [Retro, Retrospective]
        2: [Plan, Ablaufplan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $titleId1 = $chooser->chooseTitleId('1-2-3-4-5', 'de');
        $titleId2 = $chooser->chooseTitleId('1-2-3-4-6', 'de');
        $this->assertNotEquals($titleId2, $titleId1);

        $titleId2 = $chooser->chooseTitleId('1-2-3-4-7', 'de');
        $this->assertNotEquals($titleId2, $titleId1);
    }

    public function testChooseTitleIdPlanAlwaysGetsSameTitle()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]
    1: [   1, 2]
    2: [0, 1   ]

groups_of_terms:
    0: [Agile, Scrum, Kanban, XP]
    1: [Retro, Retrospective]
    2: [Plan, Agenda]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);

        $titleId1 = $chooser->chooseTitleId('1-2-3-4-5');

        // if it works 100 times in a row, we believe it always works
        for ($i = 0; $i < 100; $i++) {
            $titleId2 = $chooser->chooseTitleId('1-2-3-4-5');
            $this->assertEquals($titleId2, $titleId1);
        }
    }

    public function testChooseTitleIdMaxLength()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: ["", "Agile", "Scrum", "Kanban", "XP"]
    1: ["", "Retro", "Retrospective"]
    2: ["Plan", "Agenda"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $planId = '1-2-3-4-5';
        $maxLengthIncludingPlanId = strlen('Agenda'.': '.'1-2-3-4-5');
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title, $maxLengthIncludingPlanId);

        $titleId = $chooser->chooseTitleId($planId);
        $titleString = $title->render($titleId);
        $fullTitle = $titleString.' '.$planId;

        $this->assertLessThanOrEqual(
            $maxLengthIncludingPlanId,
            strlen($fullTitle),
            'This is longer than '.$maxLengthIncludingPlanId.': '.$fullTitle
        );
    }

    /**
     * @expectedException \AppBundle\Plan\Exception\NoGroupLeftToDrop
     */
    public function testChooseTitleIdMaxLengthNotFeasible()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0]

groups_of_terms:
    0: ["Foo"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $planId = '1-2-3-4-5';
        $maxLengthIncludingPlanId = 2;
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title, $maxLengthIncludingPlanId);

        $chooser->chooseTitleId($planId);
    }

    public function testDropOptionalTermsUntilShortEnough()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

groups_of_terms:
    0: ["foo"]
    1: ["", "bar1"]
    2: ["", "bar2"]
    3: ["", "bar3"]
    4: ["", "bar4"]
    5: ["", "bar5"]
    6: ["", "bar6"]
    7: ["", "bar7"]
    8: ["", "bar8"]
    9: ["", "bar9"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $titleId1 = '0:0-1-1-1-1-1-1-1-1-1';
        $planId = '1-2-3-4-5';
        $maxLengthIncludingPlanId = strlen('foo'.': '.$planId);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title, $maxLengthIncludingPlanId);

        $titleId2 = $chooser->dropOptionalTermsUntilShortEnough($titleId1, $planId);

        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $titleId2);
    }

    public function testDropOneOptionalTerm()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: ["", "Agile", "Scrum", "Kanban", "XP"]
    1: ["", "Retro", "Retrospective"]
    2: ["Plan", "Agenda"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);
        $titleId1 = '0:0-2-0';
        $titleId2 = $chooser->dropOneOptionalTerm($titleId1);
        $this->assertEquals('0:0-0-0', $titleId2);
    }

    public function testDropOneOptionalTermDeterministicRandomness()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

groups_of_terms:
    0: ["foo"]
    1: ["", "bar1"]
    2: ["", "bar2"]
    3: ["", "bar3"]
    4: ["", "bar4"]
    5: ["", "bar5"]
    6: ["", "bar6"]
    7: ["", "bar7"]
    8: ["", "bar8"]
    9: ["", "bar9"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title);
        $titleId1 = '0:0-1-1-1-1-1-1-1-1-1';

        // some term is dropped
        mt_srand(0);
        $titleId2 = $chooser->dropOneOptionalTerm($titleId1);
        $this->assertNotEquals('0:0-1-1-1-1-1-1-1-1-1', $titleId2);

        // same seed, same term dropped
        mt_srand(0);
        $titleId3 = $chooser->dropOneOptionalTerm($titleId1);
        $this->assertNotEquals('0:0-1-1-1-1-1-1-1-1-1', $titleId3);
        $this->assertEquals($titleId2, $titleId3);

        // different seed, different terms dropped
        mt_srand(1);
        $titleId4 = $chooser->dropOneOptionalTerm($titleId1);
        $this->assertNotEquals('0:0-1-1-1-1-1-1-1-1-1', $titleId4);
        $this->assertNotEquals($titleId2, $titleId4);
    }

    public function testIsShortEnough()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: ["", "Agile", "Scrum", "Kanban", "XP"]
    1: ["", "Retro", "Retrospective"]
    2: ["Plan", "Agenda"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $maxLengthIncludingPlanId = 15;
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title, $maxLengthIncludingPlanId);
        $planId = '1-2-3-4-5';

        $this->assertFalse($chooser->isShortEnough('0:1-1-1', $planId));
        $this->assertTrue($chooser->isShortEnough('0:0-0-0', $planId));
    }
}
