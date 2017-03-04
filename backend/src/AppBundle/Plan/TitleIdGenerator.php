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

    public function generateIds($sequenceId)
    {
        $termIdsInCombination = [];

        foreach ($this->sequenceOfGroups[$sequenceId] as $groupId) {
            if (1 === count($this->groupsOfTerms[$groupId])) {
                $termId = 0;
                $termIdsInCombination[] = $termId;
            }
            // foreach ($this->groupsOfTerms[$groupId] as $termId => $term) {
            // we can skip the loop, as long as each group only has one term:

            // we can skip collectiong multiple combinations, as long as each group only has one term:
            // $combinations[] = ...
            // }
        }

        return [$sequenceId.':'.implode('-', $termIdsInCombination)];
    }
}