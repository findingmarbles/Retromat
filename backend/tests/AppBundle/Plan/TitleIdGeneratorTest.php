<?php

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleIdGenerator;
use Symfony\Component\Yaml\Yaml;

class TitleIdGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testCountCombinationsInSequenceSingle()
    {
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retrospective]
    2: [Plan]
'
        );
        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(1, $generator->countCombinationsInSequence(0));
    }

    public function testCountCombinationsInSequenceMultiple()
    {
        $titleParts = Yaml::parse(
            '
sequence_of_groups:
    0: [0, 1]
    1: [0, 1, 2]
    2: [2, 3, 4]
    3: [0, 1, 2, 3, 4]

groups_of_terms:
    0: [Agile, Scrum]
    1: [Retrospective]
    2: [Plan, Agenda]
    3: [Number]
    4: [1-2-3-4-5, 6-7-8-9-10, 11-12-13-14-15, 16-17-17-19-20]
'
        );
        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(2, $generator->countCombinationsInSequence(0));
        $this->assertEquals(4, $generator->countCombinationsInSequence(1));
        $this->assertEquals(8, $generator->countCombinationsInSequence(2));
        $this->assertEquals(16, $generator->countCombinationsInSequence(3));
    }
}
