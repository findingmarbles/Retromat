<?php

namespace App\Model\Activity\Localizer;

use App\Entity\Activity;
use App\Model\Activity\Expander\ActivityExpander;

final class ActivityLocalizer
{
    private const LOCALE_DEFAULT = 'en';

    private ActivityExpander $activityExpander;

    public function __construct(ActivityExpander $activityExpander)
    {
        $this->activityExpander = $activityExpander;
    }

    public function localize(array $activities, string $locale = self::LOCALE_DEFAULT, bool $expandSource = false): array
    {
        $localizedActivities = [];
        foreach ($activities as $activity) {
            /** @var $activity Activity */
            if (!$activity->translate($locale, false)->isEmpty()) {
                if ($expandSource) {
                    $this->activityExpander->expandSource($activity);
                }
                $localizedActivities[] = $activity;
            } else {
                break;
            }
        }

        return $localizedActivities;
    }
}
