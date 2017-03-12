<?php
declare(strict_types = 1);

namespace AppBundle\Plan;

use AppBundle\Twig\Title;

class TitleIdChooser
{
    private $sequenceOfGroups;

    private $groupsOfTerms;

    private $title;

    private $maxLengthIncludingPlanId;

    public function __construct(array $titleParts, Title $title = null, int $maxLengthIncludingPlanId = PHP_INT_MAX)
    {
        $this->sequenceOfGroups = $titleParts['sequence_of_groups'];
        $this->groupsOfTerms = $titleParts['groups_of_terms'];
        $this->title = $title;
        $this->maxLengthIncludingPlanId = $maxLengthIncludingPlanId;
    }

    public function chooseTitleId(string $activityIdsString): string
    {
        $activityIds = explode('-', $activityIdsString);
        if (5 !== count($activityIds)) {
            return '';
        }

        $planNumber = (int)implode('0', $activityIds);
        mt_srand($planNumber);

        $chosenSequenceId = mt_rand(0, count($this->sequenceOfGroups) - 1);
        $groupIds = $this->sequenceOfGroups[$chosenSequenceId];

        $chosenTermIds = [];
        foreach ($groupIds as $groupId) {
            $groupOfTerms = $this->groupsOfTerms[$groupId];
            $chosenTermIds[] = mt_rand(0, count($groupOfTerms) - 1);
        }

        return $chosenSequenceId.':'.implode('-', $chosenTermIds);
    }

    public function isShortEnough(string $titleId, string $activityIdsString)
    {
        return $this->maxLengthIncludingPlanId >= strlen($this->title->render($titleId).' '.$activityIdsString);
    }
}