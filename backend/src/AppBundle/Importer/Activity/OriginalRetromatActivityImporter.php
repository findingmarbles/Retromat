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

        return substr($this->activities, $start, $end - $start);
    }

    // this may later generalize into extractInteger
    public function extractActivityPhase($activityBlock)
    {
        $key = 'phase:';
        $lineNumber = 0;

        $line = explode("\n", $activityBlock)[$lineNumber];

        if (0 !== strpos($line, $key)) {
            throw new ActivitySyntaxException('Key '.$key.' is expected at the beginning of line '.$lineNumber.'.');
        }

        $start = strlen($key);
        $end = strpos($line, ',', $start);

        return intval(trim(substr($line, $start, $end - $start)));
    }

    public function extractActivityName($activityBlock)
    {
        return $this->extractActivityStringValue($activityBlock, $key = 'name:', $lineNumber = 1);
    }

    public function extractActivitySummary($activityBlock)
    {
        return $this->extractActivityStringValue($activityBlock, $key = 'summary:', $lineNumber = 2);
    }

    /**
     * @param $activityBlock
     * @param $lineNumber
     * @param $key
     * @return string
     * @throws ActivitySyntaxException
     */
    private function extractActivityStringValue($activityBlock, $key, $lineNumber)
    {
        $line = explode("\n", $activityBlock)[$lineNumber];

        if (0 !== strpos($line, $key)) {
            throw new ActivitySyntaxException('Key '.$key.' is expected at the beginning of line '.$lineNumber.'.');
        }

        $start = strpos($line, '"') + strlen('"');
        $end = strpos($line, '",', $start);

        return substr($line, $start, $end - $start);
    }
}