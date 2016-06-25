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

}