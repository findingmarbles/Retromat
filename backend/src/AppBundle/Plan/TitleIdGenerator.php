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

    public function generateIdsForAllSequences()
    {
        $allCombinationIds = [];
        foreach ($this->sequenceOfGroups as $sequenceId => $group) {
            $allCombinationIds = array_merge($allCombinationIds, $this->generateIds($sequenceId));
        }

        return $allCombinationIds;
    }

    public function generateIds($sequenceId)
    {
        $this->allCombinations = [];
        foreach ($this->sequenceOfGroups[$sequenceId] as $groupId) {
            $this->allCombinationsAppend($this->groupsOfTerms[$groupId]);
        }

        $combinationIds = [];
        foreach ($this->allCombinations as $combination) {
            $combinationIds[] = $sequenceId.':'.implode('-', $combination);
        }

        return $combinationIds;
    }

    private function allCombinationsAppend($termsAndIds)
    {
        if (0 === count($this->allCombinations)) {
            $this->allCombinations[0] = [];
        };

        if (1 === count($termsAndIds)) {
            $this->allCombinationsAppendSingleTermId(0);
        } else {
            $this->allCombinationsMultiplyAndAppendMultipleTermIds($termsAndIds);
        }
    }

    private function allCombinationsAppendSingleTermId($termId)
    {
        for ($i = 0; $i < count($this->allCombinations); $i++) {
            $this->allCombinations[$i][] = $termId;
        }
    }

    private function allCombinationsMultiplyAndAppendMultipleTermIds($termsAndIds)
    {
        $previousAllCombinations = $this->allCombinations;
        $this->allCombinations = [];
        foreach ($termsAndIds as $termId => $term) {
            foreach ($previousAllCombinations as $combination) {
                $combination[] = $termId;
                $this->allCombinations[] = $combination;
            }
        }
    }
}