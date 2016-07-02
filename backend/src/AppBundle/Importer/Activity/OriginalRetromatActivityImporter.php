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

    public function extractActivity($activityBlock)
    {
        $activity = [
            'phase' => $this->extractActivityPhase($activityBlock),
            'name' => $this->extractActivityName($activityBlock),
            'summary' => $this->extractActivitySummary($activityBlock),
            'desc' => $this->extractActivityDescription($activityBlock),
            'source' => $this->extractActivitySource($activityBlock),
            'more' => $this->extractActivityMore($activityBlock),
            'duration' => $this->extractActivityDuration($activityBlock),
            'suitable' => $this->extractActivitySuitable($activityBlock),
        ];

        return $activity;
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

    public function extractActivityName($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'name:');
    }

    public function extractActivitySummary($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'summary:');
    }

    public function extractActivityDescription($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'desc:');
    }

    public function extractActivityDuration($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'duration:');
    }

    public function extractActivityMore($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'more:');
    }

    public function extractActivitySuitable($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'suitable:');
    }

    public function extractActivityPhase($activityBlock)
    {
        $key = 'phase:';

        if (0 !== strpos($activityBlock, $key)) {
            throw new ActivitySyntaxException('Key '.$key.' is expected at the beginning of the activity block.');
        }

        $start = strlen($key);
        $end = strpos($activityBlock, ',', $start);

        return intval(trim(substr($activityBlock, $start, $end - $start)));
    }

    public function extractActivitySource($activityBlock)
    {
        $key = 'source:';

        $keyPosition = strpos($activityBlock, "\n".$key) + 1;
        $endOfLine = strpos($activityBlock, "\n", $keyPosition);
        if (false === $endOfLine) {
            $endOfLine = strlen($activityBlock);
        }

        // identify the first non-whitespace after the key "source: "
        for ($start = $keyPosition + strlen($key); $start <= $endOfLine; $start++) {
            if (!ctype_space($activityBlock[$start])) {
                break;
            }
        }

        // if 'source:' is the last acitvity in the block, there's sometimes no comma
        if (',' == $activityBlock[$endOfLine - 1]) {
            $end = $endOfLine - 1;
        } else {
            $end = $endOfLine;
        }

        return substr($activityBlock, $start, $end - $start);
    }

    /**
     * @param $activityBlock
     * @param $key
     * @return string
     */
    private function extractStringValue($activityBlock, $key)
    {
        $keyPosition = strpos($activityBlock, "\n".$key) + 1;
        $start = strpos($activityBlock, '"', $keyPosition + strlen($key)) + strlen('"');
        $end = strpos($activityBlock, '"', $start);

        return substr($activityBlock, $start, $end - $start);
    }
}