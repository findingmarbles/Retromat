<?php
declare(strict_types=1);

namespace AppBundle\Plan;

class TitleIdChooser
{
    public function chooseTitleId(string $activityIdsString): string
    {
        $activityIds = explode('-', $activityIdsString);
        if (5 !== count($activityIds)) {
            return '';
        }

        return '0:0-0-0';
    }
}