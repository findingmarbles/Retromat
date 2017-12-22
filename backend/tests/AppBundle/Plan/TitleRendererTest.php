<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleRenderer;
use Symfony\Component\Yaml\Yaml;

class TitleRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderDifferentTerms()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'), Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);

        $this->assertEquals('Agile Retrospective Plan', $title->render('0:0-0-0'));
        $this->assertEquals('Scrum Retrospective Plan', $title->render('0:1-0-0'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderDifferentTermsDe()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'), Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);

        $this->assertEquals('Agile Retrospective Plan', $title->render('0:0-0-0', 'de'));
        $this->assertEquals('Scrum Retrospective Plan', $title->render('0:1-0-0', 'de'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderDifferentSequences()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'), Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);

        $this->assertEquals('Retrospective Plan', $title->render('2:0-0'));
        $this->assertEquals('Agile Retrospective', $title->render('1:0-0'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderDifferentSequencesDe()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'), Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);

        $this->assertEquals('Retrospective Plan', $title->render('2:0-0', 'de'));
        $this->assertEquals('Agile Retrospective', $title->render('1:0-0', 'de'));
    }

    /**
     * @expectedException \AppBundle\Twig\Exception\InconsistentInputException
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderWrongNumberOfIds()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'), Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);

        $title->render('1:0-0-0');
    }

    /**
     * @expectedException \AppBundle\Twig\Exception\InconsistentInputException
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderWrongNumberOfIdsDe()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'), Yaml::PARSE_KEYS_AS_STRINGS);
        $title = new TitleRenderer($titleParts);

        $title->render('1:0-0-0', 'de');
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderNoSuperfluousWhitespace()
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
        $this->assertEquals('Plan', $title->render('0:0-0-0'));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderNoSuperfluousWhitespaceDe()
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
        $this->assertEquals('Plan', $title->render('0:0-0-0', 'de'));
    }
}
