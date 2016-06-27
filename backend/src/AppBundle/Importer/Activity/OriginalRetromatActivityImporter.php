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
        $key = 'name:';
        $lineNumber = 1;

        $line = explode("\n", $activityBlock)[$lineNumber];

        if (0 !== strpos($line, $key)) {
            throw new ActivitySyntaxException('Key '.$key.' is expected at the beginning of line '.$lineNumber.'.');
        }

        $start = strpos($line, '"') + strlen('"');
        $end = strpos($line, '",', $start);

        return substr($line, $start, $end - $start);
    }

    // this was introduced expecting that it may help unify extractActivityPhase and extractActivityName
    // not used yet, may need to be removed again
    public function unquoteIfHasQuotes($string)
    {
        if (0 === strpos($string, '"') and 0 === strpos(strrev($string), '"')) {
            return substr($string, 1, strlen($string) - 2);
        } else {
            return $string;
        }
    }
}