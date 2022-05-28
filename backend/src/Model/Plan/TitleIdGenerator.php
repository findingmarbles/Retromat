<?php

declare(strict_types=1);

namespace App\Model\Plan;

use App\Model\Plan\Exception\InconsistentInputException;

class TitleIdGenerator
{
    /**
     * @var array
     */
    private $parts = [];

    public function __construct(array $titleParts)
    {
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
        $parts = $this->extractTitleParts($locale);

        $numberOfCombinations = 1;
        foreach ($parts['sequence_of_groups'][$id] as $groupId) {
            $numberOfCombinations *= \count($parts['groups_of_terms'][$groupId]);
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
        $parts = $this->extractTitleParts($locale);

        $numberOfCombinations = 0;
        foreach ($parts['sequence_of_groups'] as $id => $value) {
            $numberOfCombinations += $this->countCombinationsInSequence($id, $locale);
        }

        return $numberOfCombinations;
    }

    /**
     * @param string $locale
     * @return array
     * @throws InconsistentInputException
     */
    private function extractTitleParts(string $locale): array
    {
        if (\array_key_exists($locale, $this->parts)) {
            return $this->parts[$locale];
        } else {
            throw new InconsistentInputException('Locale not found in parts: '.$locale);
        }
    }
}
