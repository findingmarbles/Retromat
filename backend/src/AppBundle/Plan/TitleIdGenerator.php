<?php

namespace AppBundle\Plan;

class TitleIdGenerator
{
    private $sequenceOfGroups;
    private $groupsOfTerms;

    public function __construct(array $titleParts)
    {
        $this->sequenceOfGroups = $titleParts['sequence_of_groups'];
        $this->groupsOfTerms = $titleParts['groups_of_terms'];
    }

    public function countCombinationsInSequence($id)
    {
        $numberOfCombinations = 1;
        foreach ($this->sequenceOfGroups[$id] as $groupId) {
            $numberOfCombinations *= count($this->groupsOfTerms[$groupId]);
        }

        return $numberOfCombinations;
    }

    public function countCombinationsInAllSequences()
    {
        $numberOfCombinations = 0;
        foreach ($this->sequenceOfGroups as $id => $value) {
            $numberOfCombinations += $this->countCombinationsInSequence($id);
        }

        return $numberOfCombinations;
    }
}