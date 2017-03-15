<?php
declare(strict_types = 1);

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleRenderer;
use Symfony\Component\Yaml\Yaml;

class TitleRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderDifferentTerms()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'));
        $title = new TitleRenderer($titleParts);

        $this->assertEquals('Agile Retrospective Plan', $title->render('0:0-0-0'));
        $this->assertEquals('Scrum Retrospective Plan', $title->render('0:1-0-0'));
    }

    public function testRenderDifferentSequences()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'));
        $title = new TitleRenderer($titleParts);

        $this->assertEquals('Retrospective Plan', $title->render('2:0-0'));
        $this->assertEquals('Agile Retrospective', $title->render('1:0-0'));
    }

    /**
     * @expectedException \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderWrongNumberOfIds()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'));
        $title = new TitleRenderer($titleParts);

        $title->render('1:0-0-0');
    }

    public function testRenderNoSuperfluousWhitespace()
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
        $title = new TitleRenderer($titleParts);
        $this->assertEquals('Plan', $title->render('0:0-0-0'));
    }
}
