<?php
declare(strict_types = 1);

namespace AppBundle\Plan;

use AppBundle\Twig\Exception\InconsistentInputException;

class TitleIdGenerator
{
    private $sequenceOfGroups;

    private $groupsOfTerms;

    /**
     * @var array
     */
    private $parts = [];

    public function __construct(array $titleParts)
    {
        $this->sequenceOfGroups = $titleParts['sequence_of_groups'];
        $this->groupsOfTerms = $titleParts['groups_of_terms'];
        $this->parts = $titleParts;
    }

    /**
     * @param int $id
     * @param string $locale
     * @return int
     * @throws InconsistentInputException
     */
    public function countCombinationsInSequence(int $id, string $locale = 'en'): int
    {
        if ('en' === $locale) {
            $parts = $this->parts;
        } else {
            if (array_key_exists($locale, $this->parts)) {
                $parts = $this->parts[$locale];
            } else {
                throw new InconsistentInputException('Locale not found in parts: '.$locale);
            }
        }

        $numberOfCombinations = 1;
        foreach ($parts['sequence_of_groups'][$id] as $groupId) {
            $numberOfCombinations *= count($parts['groups_of_terms'][$groupId]);
        }

        return $numberOfCombinations;
    }

    /**
     * @param string $locale
     * @return int
     * @throws InconsistentInputException
     */
    public function countCombinationsInAllSequences(string $locale = 'en'): int
    {
        $numberOfCombinations = 0;
        foreach ($this->sequenceOfGroups as $id => $value) {
            $numberOfCombinations += $this->countCombinationsInSequence($id, $locale);
        }

        return $numberOfCombinations;
    }
}