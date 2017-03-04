<?php

namespace AppBundle\Plan;

class TitleIdGenerator
{
    private $sequenceOfGroups;
    private $groupsOfTerms;
    private $allCombinations;

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
        $this->allCombinations = [];

        foreach ($this->sequenceOfGroups[$sequenceId] as $groupId) {
            if (1 === count($this->groupsOfTerms[$groupId])) {
                $termId = 0;
                $this->allCombinationsAppendSingleTermId($termId);
            }
            // foreach ($this->groupsOfTerms[$groupId] as $termId => $term) {
            // we can skip the loop, as long as each group only has one term:

            // we can skip collectiong multiple combinations, as long as each group only has one term:
            // $combinations[] = ...
            // }
        }

        $combinationIds = [];
        foreach ($this->allCombinations as $combination) {
            $combinationIds[] = $sequenceId.':'.implode('-', $combination);
        }

        return $combinationIds;
    }

    private function allCombinationsAppendSingleTermId($termId)
    {
        if (0 === count($this->allCombinations)) {
            $this->allCombinations[0] = [$termId];
        } else {
            for ($i =0 ; $i < count($this->allCombinations) ; $i++) {
                $this->allCombinations[$i][] = $termId;
            }
        }
    }
}