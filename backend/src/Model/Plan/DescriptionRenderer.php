<?php

declare(strict_types=1);

namespace App\Model\Plan;

class DescriptionRenderer
{
    /**
     * @param array $activities
     * @return string
     */
    public function render(array $activities): string
    {
        if (5 !== \count($activities)) {
            return '';
        }

        return
            $activities[0]->getRetromatId().', '.
            $activities[1]->getRetromatId().': '.$activities[1]->getSummary().', '.
            $activities[2]->getRetromatId().': '.$activities[2]->getSummary().', '.
            $activities[3]->getRetromatId().', '.
            $activities[4]->getRetromatId();
    }
}
