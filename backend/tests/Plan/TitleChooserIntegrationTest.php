<?php
declare(strict_types = 1);

namespace App\Tests\Plan;

use App\Model\Plan\Exception\NoGroupLeftToDrop;
use App\Model\Plan\TitleChooser;
use App\Model\Plan\TitleRenderer;
use Symfony\Component\Yaml\Yaml;
use App\Model\Plan\Exception\InconsistentInputException;

class TitleChooserIntegrationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testRenderTitleSingleChoice()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testRenderTitleSingleChoiceDe()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testRenderTitleEmptyUnless5Activities()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testRenderTitleEmptyUnless5ActivitiesDe()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdEmptyUnless5Activities()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdEmptyUnless5ActivitiesDe()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdCorrectFormat()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdCorrectFormatDe()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdDifferentPlansGetDifferentTitles()
    {
        $yaml = <<<YAML
en:
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdDifferentPlansGetDifferentTitlesDe()
    {
        $yaml = <<<YAML
en:
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

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdPlanAlwaysGetsSameTitle()
    {
        $yaml = <<<YAML
en:        
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

        // if it works 100 times in a row, we believe it always works
        for ($i = 0; $i < 100; $i++) {
            $titleId2 = $chooser->chooseTitleId('1-2-3-4-5');
            $this->assertEquals($titleId2, $titleId1);
        }
    }

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdPlanAlwaysGetsSameTitleDe()
    {
        $yaml = <<<YAML
en:
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

        // if it works 100 times in a row, we believe it always works
        for ($i = 0; $i < 100; $i++) {
            $titleId2 = $chooser->chooseTitleId('1-2-3-4-5', 'de');
            $this->assertEquals($titleId2, $titleId1);
        }
    }

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdMaxLength()
    {
        $yaml = <<<YAML
en:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: ["", "Agile", "Scrum", "Kanban", "XP"]
        1: ["", "Retro", "Retrospective"]
        2: ["Plan", "Agenda"]

de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agiler, Scrum, Kanban, XP]
        1: [Retro, Retrospective]
        2: [Plan, Ablaufplan]
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
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testChooseTitleIdMaxLengthDe()
    {
        $yaml = <<<YAML
en:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: ["", "Agile", "Scrum", "Kanban", "XP"]
        1: ["", "Retro", "Retrospective"]
        2: ["Plan", "Agenda"]

de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: ["", Agiler, Scrum, Kanban, XP]
        1: ["", Retro, Retrospective]
        2: [Plan, Ablaufplan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $planId = '1-2-3-4-5';
        $maxLengthIncludingPlanId = strlen('Agenda'.': '.'1-2-3-4-5');
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title, $maxLengthIncludingPlanId);

        $titleId = $chooser->chooseTitleId($planId, 'de');
        $titleString = $title->render($titleId, 'de');
        $fullTitle = $titleString.' '.$planId;

        $this->assertLessThanOrEqual(
            $maxLengthIncludingPlanId,
            strlen($fullTitle),
            'This is longer than '.$maxLengthIncludingPlanId.': '.$fullTitle
        );
    }

    /**
     * @throws InconsistentInputException
     * @expectedException NoGroupLeftToDrop
     */
    public function testChooseTitleIdMaxLengthNotFeasible()
    {
        $yaml = <<<YAML
en:
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

    /**
     * @throws InconsistentInputException
     * @expectedException NoGroupLeftToDrop
     */
    public function testChooseTitleIdMaxLengthNotFeasibleDe()
    {
        $yaml = <<<YAML
en:
    sequence_of_groups:
        0: [0]
    
    groups_of_terms:
        0: ["Foo"]

de:
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

        $chooser->chooseTitleId($planId, 'de');
    }

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testDropOptionalTermsUntilShortEnough()
    {
        $yaml = <<<YAML
en:
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

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testDropOptionalTermsUntilShortEnoughDe()
    {
        $yaml = <<<YAML
en:
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

de:
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

        $titleId2 = $chooser->dropOptionalTermsUntilShortEnough($titleId1, $planId, 'de');

        $this->assertEquals('0:0-0-0-0-0-0-0-0-0-0', $titleId2);
    }

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testDropOneOptionalTerm()
    {
        $yaml = <<<YAML
en:
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

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testDropOneOptionalTermDe()
    {
        $yaml = <<<YAML
en:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: ["", "Agile", "Scrum", "Kanban", "XP"]
        1: ["", "Retro", "Retrospective"]
        2: ["Plan", "Agenda"]

de:
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
        $titleId2 = $chooser->dropOneOptionalTerm($titleId1, 'de');
        $this->assertEquals('0:0-0-0', $titleId2);
    }

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testDropOneOptionalTermDeterministicRandomness()
    {
        $yaml = <<<YAML
en:
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

    /**
     * @throws NoGroupLeftToDrop
     * @throws InconsistentInputException
     */
    public function testDropOneOptionalTermDeterministicRandomnessDe()
    {
        $yaml = <<<YAML
en:
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

de:
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
        $titleId2 = $chooser->dropOneOptionalTerm($titleId1, 'de');
        $this->assertNotEquals('0:0-1-1-1-1-1-1-1-1-1', $titleId2);

        // same seed, same term dropped
        mt_srand(0);
        $titleId3 = $chooser->dropOneOptionalTerm($titleId1, 'de');
        $this->assertNotEquals('0:0-1-1-1-1-1-1-1-1-1', $titleId3);
        $this->assertEquals($titleId2, $titleId3);

        // different seed, different terms dropped
        mt_srand(1);
        $titleId4 = $chooser->dropOneOptionalTerm($titleId1, 'de');
        $this->assertNotEquals('0:0-1-1-1-1-1-1-1-1-1', $titleId4);
        $this->assertNotEquals($titleId2, $titleId4);
    }

    /**
     * @throws InconsistentInputException
     */
    public function testIsShortEnough()
    {
        $yaml = <<<YAML
en:
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

    /**
     * @throws InconsistentInputException
     */
    public function testIsShortEnoughDe()
    {
        $yaml = <<<YAML
en:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: ["", "Agile", "Scrum", "Kanban", "XP"]
        1: ["", "Retro", "Retrospective"]
        2: ["Plan", "Agenda"]

de:
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

        $this->assertFalse($chooser->isShortEnough('0:1-1-1', $planId, 'de'));
        $this->assertTrue($chooser->isShortEnough('0:0-0-0', $planId, 'de'));
    }

    /**
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    public function testChooseTitleIdLocaleHandlingRu()
    {
        $yaml = <<<YAML
ru:
    sequence_of_groups:
        0:  [ 0,     1,  3,   5, 6, 7, 8,   10     ]
        1:  [ 0,       2,  4, 5, 6, 7,    9        ]
        2:  [ 0,     1,  3,   5, 6, 7, 8,   10     ]
        3:  [ 0,       2,  4, 5, 6, 7,    9        ]
        4:  [ 0,     1,       5,    7,          11 ]
        5:  [ 0,     1,       5,       8,       11 ]
        6:  [ 0,       2,     5,    7,          11 ]
        7:  [ 0,       2,     5,       8,       11 ]
        8:  [ 0, 12, 1,  3,   5, 6,          10    ]
        9:  [ 0, 12,   2,  4, 5, 6,       9        ]
        10: [ 0, 12, 1,  3,   5, 6,          10    ]
        11: [ 0, 12,   2,  4, 5, 6,       9        ]
        12: [ 0, 13,          5, 6, 7, 8,    10    ]
        13: [ 0, 13,          5, 6, 7,    9        ]
        14: [ 0, 13,          5, 6, 7, 8,    10    ]
        15: [ 0, 13,          5, 6, 7,    9        ]

    groups_of_terms:
        # "" as first element marks the group as optional (may be skipped to satisfy length constraints)
        0: ["Retromat:"]
        1: ["", "Канбан", "Lean"] # either 1+3 (without iterations) or 2+4 (with iteration)
        2: ["", "Аджайл", "Скрам", "XP", "Экстремальное программирование"]
        3: ["", "Релиз", "Проект", "Программа", "Процесс", "Команда"]
        4: ["", "Релиз", "Проект", "Программа", "Процесс", "Команда", "Итерация", "Цикл", "Спринт"]
        5: ["Ретроспектива", "Ретро", "Post Mortem", "A3", "Извлечение уроков", "Отражение", "Проверка и адаптация", "Анализ"]
        6: ["", "Встреча", "Событие", "Обсуждение", "Церемония"]
        7: ["", "План", "Повестка дня", "Структура", "Эксперимент"]
        8: ["", "Идеи", "Вдохновение", "Пример"]
        9: ["", "упражнения"] # either 9 or 10
        10: ["", "с 5 действиями", "с 5 этапами", "с 5 шагами", "с 5 идеями", "с 5 видами деятельности", "с 5 примерами действий"]
        11: ["", "Генератор", "Инструмент", "Руководство", "Справочник"]
        12: ["", "Планируйте Вашу", "Организуйте Вашу", "Создайте Вашу", "Подготовьте Вашу"]
        13: ["", "Инструменты Скрам Мастера:", "Инструменты Скраммастера:", "Инструменты фасилитатора:", "Инструментарий Скрам Мастера:", "Инструментарий Скраммастера:", "Инструментарий фасилитатора:"]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $maxLengthIncludingPlanId = 60;
        $title = new TitleRenderer($titleParts);
        $chooser = new TitleChooser($titleParts, $title, $maxLengthIncludingPlanId);

        $titleId = $chooser->chooseTitleId('70-4-8-11-14', 'ru');
        $this->assertEquals('11:0-1-0-6-7-0-0', $titleId);
    }
}
