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
        $line = explode("\n", $activityBlock)[0];

        if (0 === strpos($line, 'phase:')) {
            $start = strpos($line, 'phase:') + strlen('phase:');
            $end = strpos($line, ',', $start);

            return intval(trim(substr($line, $start, $end-$start)));
        } else {
            throw new ActivitySyntaxException('For simplicity, "phase:" is expected at the beginning block.');
        }
    }

    public function extractActivityName($activityBlock)
    {
        $line = explode("\n", $activityBlock)[1];

        if (0 === strpos($line, 'name:')) {
            $startValue = strpos($line, 'name:') + strlen('name:');
            $start = strpos($line, '"', $startValue) + strlen('"');
            $end = strpos($line, '"', $start);

            return trim(substr($line, $start, $end-$start));
        } else {
            throw new ActivitySyntaxException('For simplicity, "name:" is expected in line 2 of the block.');
        }
    }
}