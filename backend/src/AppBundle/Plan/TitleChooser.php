<?php
declare(strict_types = 1);

namespace AppBundle\Plan;

use AppBundle\Plan\Exception\NoGroupLeftToDrop;
use AppBundle\Plan\TitleRenderer;
use AppBundle\Plan\Exception\InconsistentInputException;

class TitleChooser
{
    /**
     * @var array
     */
    private $parts = [];

    /**
     * @var TitleRenderer
     */
    private $titleRenderer;

    /**
     * @var int
     */
    private $maxLengthIncludingPlanId;

    /**
     * TitleIdChooser constructor.
     * @param array $titleParts
     * @param TitleRenderer|null $title
     * @param int $maxLengthIncludingPlanId
     */
    public function __construct(array $titleParts, TitleRenderer $title, int $maxLengthIncludingPlanId = PHP_INT_MAX)
    {
        $this->parts = $titleParts;
        $this->titleRenderer = $title;
        $this->maxLengthIncludingPlanId = $maxLengthIncludingPlanId;
    }

    /**
     * @param string $activityIdsString
     * @param string $locale
     * @return string
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    public function renderTitle(string $activityIdsString, string $locale = 'en'): string
    {
        if (5 !== count(explode('-', $activityIdsString))) {
            return '';
        }

        return $this->titleRenderer->render($this->chooseTitleId($activityIdsString), $locale).': '.$activityIdsString;
    }

    /**
     * @param string $activityIdsString
     * @param string $locale
     * @return string
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    public function chooseTitleId(string $activityIdsString, string $locale = 'en'): string
    {
        $parts = $this->extractTitleParts($locale);

        // parse input
        $activityIds = explode('-', $activityIdsString);
        if (5 !== count($activityIds)) {
            return '';
        }

        // use input to seed the random number generator so we get deterministic randomness
        $planNumber = (int)implode('0', $activityIds);
        mt_srand($planNumber);

        // randomly choose a squence to use and identify the groups of terms in it
        $chosenSequenceId = mt_rand(0, count($parts['sequence_of_groups']) - 1);
        $groupIds = $parts['sequence_of_groups'][$chosenSequenceId];

        // randomly choose one term from each group in the sequence
        $chosenTermIds = [];
        foreach ($groupIds as $groupId) {
            $groupOfTerms = $parts['groups_of_terms'][$groupId];
            $chosenTermIds[] = mt_rand(0, count($groupOfTerms) - 1);
        }

        // take care of $maxLengthIncludingPlanId
        $titleId = $chosenSequenceId.':'.implode('-', $chosenTermIds);
        $titleId = $this->dropOptionalTermsUntilShortEnough($titleId, $activityIdsString, $locale);

        return $titleId;
    }

    /**
     * @param string $titleId
     * @param string $planId
     * @param string $locale
     * @return string
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    public function dropOptionalTermsUntilShortEnough(string $titleId, string $planId, string $locale = 'en'): string
    {
        while (!$this->isShortEnough($titleId, $planId, $locale)) {
            $titleId = $this->dropOneOptionalTerm($titleId, $locale);
        }

        return $titleId;
    }

    /**
     * @param string $titleId
     * @param string $locale
     * @return string
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    public function dropOneOptionalTerm(string $titleId, string $locale = 'en'): string
    {
        $parts = $this->extractTitleParts($locale);

        // parse titleId
        $idStringParts = explode(':', $titleId);
        $sequenceOfGroupsId = $idStringParts[0];
        $sequenceOfGroups = $parts['sequence_of_groups'][$sequenceOfGroupsId];
        $fragmentIds = explode('-', $idStringParts[1]);
        unset($titleId, $idStringParts);

        // find non-empty optional terms
        $nonEmptyOptionalGroupIds = [];
        for ($i = 0; $i < count($fragmentIds); $i++) {
            // non-empty (by convention, empty string must be listed first and therefore are id == 0)
            if (0 != $fragmentIds[$i]) {
                // by convention, optional groups are marked by having an empty string as their first term
                if (0 == strlen($parts['groups_of_terms'][$sequenceOfGroups[$i]][0])) {
                    $nonEmptyOptionalGroupIds[] = $i;
                }
            }
        }
        if (empty($nonEmptyOptionalGroupIds)) {
            throw new NoGroupLeftToDrop(
                'Cannot drop enough groups to satisfy maximum length requirement: '.
                $sequenceOfGroupsId.':'.implode('-', $fragmentIds)
            );
        }

        // drop one term (random choice)
        $termIdToDrop = $nonEmptyOptionalGroupIds[mt_rand(0, count($nonEmptyOptionalGroupIds) - 1)];
        $fragmentIds[$termIdToDrop] = 0;

        return $sequenceOfGroupsId.':'.implode('-', $fragmentIds);
    }

    /**
     * @param string $titleId
     * @param string $activityIdsString
     * @param string $locale
     * @return bool
     * @throws InconsistentInputException
     */
    public function isShortEnough(string $titleId, string $activityIdsString, string $locale = 'en'): bool
    {
        return $this->maxLengthIncludingPlanId >= mb_strlen(
                $this->titleRenderer->render($titleId, $locale).': '.$activityIdsString
            );
    }

    /**
     * @param string $locale
     * @return array
     * @throws InconsistentInputException
     */
    private function extractTitleParts(string $locale): array
    {
        if (array_key_exists($locale, $this->parts)) {
            return $this->parts[$locale];
        } else {
            throw new InconsistentInputException('Locale not found in parts: '.$locale);
        }
    }
}