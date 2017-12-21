<?php

namespace tests\AppBundle\Plan;

use AppBundle\Plan\TitleIdGenerator;
use Symfony\Component\Yaml\Yaml;

class TitleIdGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testCountCombinationsInSequenceSingle()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retrospective]
    2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);

        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(1, $generator->countCombinationsInSequence(0));
    }

    /**
     * @throws \AppBundle\Twig\Exception\InconsistentInputException
     */
    public function testCountCombinationsInSequenceSingleDe()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retrospective]
    2: [Plan]

de:
    sequence_of_groups:
        0: [0, 1, 2]
    
    groups_of_terms:
        0: [Agile]
        1: [Retrospective]
        2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);

        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(1, $generator->countCombinationsInSequence(0, 'de'));
    }

    public function testCountCombinationsInSequenceMultiple()
    {
        $yaml = <<<YAML
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
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);

        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(2, $generator->countCombinationsInSequence(0));
        $this->assertEquals(4, $generator->countCombinationsInSequence(1));
        $this->assertEquals(8, $generator->countCombinationsInSequence(2));
        $this->assertEquals(16, $generator->countCombinationsInSequence(3));
    }

    public function testCountCombinationsInAllSequencesTwo()
    {
        $yaml = <<<YAML
sequence_of_groups:
    0: [0, 1]
    1: [1, 2]

groups_of_terms:
    0: [Agile]
    1: [Retrospective]
    2: [Plan]
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);

        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(2, $generator->countCombinationsInAllSequences());
    }

    public function testCountCombinationsInAllSequencesMany()
    {
        $yaml = <<<YAML
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
YAML;
        $titleParts = Yaml::parse($yaml, Yaml::PARSE_KEYS_AS_STRINGS);
        $generator = new TitleIdGenerator($titleParts);

        $this->assertEquals(30, $generator->countCombinationsInAllSequences());
    }
}
