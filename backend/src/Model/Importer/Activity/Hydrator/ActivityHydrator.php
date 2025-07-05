<?php

namespace App\Model\Importer\Activity\Hydrator;

use App\Entity\Activity;

final class ActivityHydrator
{
    public function hydrateFromArray(array $inputArray, Activity $activity): Activity
    {
        foreach ($inputArray as $property => $value) {
            $activity->{'set'.$property}($value);
        }

        return $activity;
    }
}
