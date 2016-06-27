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
        $key = 'phase:';
        $lineNumber = 0;

        $line = explode("\n", $activityBlock)[$lineNumber];

        if (0 === strpos($line, $key)) {
            $start = strlen($key);
            $end = strpos($line, ',', $start);

            return intval(trim(substr($line, $start, $end-$start)));
        } else {
            throw new ActivitySyntaxException('For simplicity, '.$key.' is expected at the beginning of line '.$lineNumber.'.');
        }
    }

    public function extractActivityName($activityBlock)
    {
        $key = 'name:';
        $lineNumber = 1;

        $line = explode("\n", $activityBlock)[$lineNumber];

        if (0 === strpos($line, $key)) {
            $start = strpos($line, '"') + strlen('"');
            $end = strpos($line, '",', $start);

            return trim(substr($line, $start, $end-$start));
        } else {
            throw new ActivitySyntaxException('For simplicity, '.$key.' is expected at the beginning of line '.$lineNumber.'.');
        }
    }
}