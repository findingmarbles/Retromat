<?php
declare(strict_types = 1);

namespace AppBundle\Plan;

use AppBundle\Plan\Exception\NoGroupLeftToDrop;
use AppBundle\Plan\TitleRenderer;

class TitleChooser
{
    /**
     * @var array
     */
    private $sequenceOfGroups;

    /**
     * @var array
     */
    private $groupsOfTerms;

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
        $this->sequenceOfGroups = $titleParts['sequence_of_groups'];
        $this->groupsOfTerms = $titleParts['groups_of_terms'];
        $this->titleRenderer = $title;
        $this->maxLengthIncludingPlanId = $maxLengthIncludingPlanId;
    }

    /**
     * @param string $activityIdsString
     * @return string
     */
    public function renderTitle(string $activityIdsString): string
    {
        return $this->titleRenderer->render($this->chooseTitleId($activityIdsString)).': '.$activityIdsString;
    }
    
    /**
     * @param string $activityIdsString
     * @return string
     */
    public function chooseTitleId(string $activityIdsString): string
    {
        // parse input
        $activityIds = explode('-', $activityIdsString);
        if (5 !== count($activityIds)) {
            return '';
        }

        // use input to seed the random number generator so we get deterministic randomness
        $planNumber = (int)implode('0', $activityIds);
        mt_srand($planNumber);

        // randomly choose a squence to use and identify the groups of terms in it
        $chosenSequenceId = mt_rand(0, count($this->sequenceOfGroups) - 1);
        $groupIds = $this->sequenceOfGroups[$chosenSequenceId];

        // randomly choose one term from each group in the sequence
        $chosenTermIds = [];
        foreach ($groupIds as $groupId) {
            $groupOfTerms = $this->groupsOfTerms[$groupId];
            $chosenTermIds[] = mt_rand(0, count($groupOfTerms) - 1);
        }

        // take care of $maxLengthIncludingPlanId
        $titleId = $chosenSequenceId.':'.implode('-', $chosenTermIds);
        $titleId = $this->dropOptionalTermsUntilShortEnough($titleId, $activityIdsString);

        return $titleId;
    }

    /**
     * @param string $titleId
     * @param string $planId
     * @return string
     */
    public function dropOptionalTermsUntilShortEnough(string $titleId, string $planId): string
    {
        while (!$this->isShortEnough($titleId, $planId)) {
            $titleId = $this->dropOneOptionalTerm($titleId);
        }

        return $titleId;
    }

    /**
     * @param string $titleId
     * @return string
     */
    public function dropOneOptionalTerm(string $titleId): string
    {
        // parse titleId
        $idStringParts = explode(':', $titleId);
        $sequenceOfGroupsId = $idStringParts[0];
        $sequenceOfGroups = $this->sequenceOfGroups[$sequenceOfGroupsId];
        $fragmentIds = explode('-', $idStringParts[1]);
        unset($titleId, $idStringParts);

        // find non-empty optional terms
        $nonEmptyOptionalGroupIds = [];
        for ($i = 0; $i < count($fragmentIds); $i++) {
            // non-empty (by convention, empty string must be listed first and therefore are id == 0)
            if (0 != $fragmentIds[$i]) {
                // by convention, optional groups are marked by having an empty string as their first term
                if (0 == strlen($this->groupsOfTerms[$sequenceOfGroups[$i]][0])) {
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
     * @return bool
     */
    public function isShortEnough(string $titleId, string $activityIdsString): bool
    {
        return $this->maxLengthIncludingPlanId >= strlen(
                $this->titleRenderer->render($titleId).' '.$activityIdsString
            );
    }
}