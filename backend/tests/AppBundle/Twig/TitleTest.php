<?php

namespace tests\AppBundle\Twig;

use AppBundle\Twig\Title;
use Symfony\Component\Yaml\Yaml;

class TitleTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderDifferentTerms()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'));
        $title = new Title($titleParts);

        $this->assertEquals('Agile Retrospective Plan', $title->render('0:0-0-0'));
        $this->assertEquals('Scrum Retrospective Plan', $title->render('0:1-0-0'));
    }

    public function testRenderDifferentSequences()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'));
        $title = new Title($titleParts);

        $this->assertEquals('Retrospective Plan', $title->render('2:0-0'));
        $this->assertEquals('Agile Retrospective', $title->render('1:0-0'));
    }

    /**
     * @expectedException \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testRenderWrongNumberOfIds()
    {
        $titleParts = Yaml::parse(file_get_contents(__DIR__.'/TestData/title_minmal.yml'));
        $title = new Title($titleParts);

        $title->render('1:0-0-0');
    }
}
