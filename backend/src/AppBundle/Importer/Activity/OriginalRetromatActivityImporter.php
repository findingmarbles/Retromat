<?php

namespace AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\Exception\ActivitySyntaxException;

class OriginalRetromatActivityImporter
{
    private $activities;

    public function __construct($fileName)
    {
        $this->activities = file_get_contents($fileName);
    }

    public function extractActivityBlock($id)
    {
        $startMarker = "{\n";
        $endMarker = "\n};";

        $blockStart = strpos($this->activities, 'all_activities['.$id.']');
        $start = strpos($this->activities, $startMarker, $blockStart) + strlen($startMarker);
        $end = strpos($this->activities, $endMarker, $start);

        return substr($this->activities, $start, $end-$start);
    }

    public function extractActivityPhase($activityBlock)
    {
        if (0 === strpos($activityBlock, 'phase:')) {
            $line0 = explode('\n', $activityBlock)[0];
            $start = strpos($line0, 'phase:') + strlen('phase:');
            $end = strpos($line0, ',', $start);

            return intval(trim(substr($line0, $start, $end-$start)));
        } else {
            throw new ActivitySyntaxException('For simplicity, "phase:" is expected at the beginning block.');
        }
    }

    public function extractActivityName($activityBlock)
    {
        $line1 = explode("\n", $activityBlock)[1];

        if (0 === strpos($line1, 'name:')) {
            $startValue = strpos($line1, 'name:') + strlen('name:');
            $start = strpos($line1, '"', $startValue) + strlen('"');
            $end = strpos($line1, '"', $start);

            return trim(substr($line1, $start, $end-$start));
        } else {
            throw new ActivitySyntaxException('For simplicity, "name:" is expected in line 2 of the block.');
        }
    }
}