<?php

namespace AppBundle\Importer\Activity;

class ActivityReader
{
    private $activities;

    public function __construct($fileName)
    {
        $this->activities = file_get_contents($fileName);
    }

    public function extractAllActivities()
    {
        $activity = [];

        for ($i=0; $i <= $this->highestActivityNumber(); $i++)
        {
            $activity[$i] = $this->extractActivity($i);
        }

        return $activity;
    }

    public function highestActivityNumber()
    {
        $key = 'all_activities[';
        $keyPosition = strrpos($this->activities, "\n".$key) + 1;

        $start = $keyPosition + strlen($key);
        $end = strpos($this->activities, ']', $start);

        return intval(trim(substr($this->activities, $start, $end - $start)));
    }

    public function extractActivity($id)
    {
        $activityBlock = $this->extractActivityBlock($id);

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

    private function extractActivityBlock($id)
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

        if (0 === strpos($activityBlock, $key)) {
            $start = strlen($key);
            $end = strpos($activityBlock, ',', $start);

            return intval(trim(substr($activityBlock, $start, $end - $start)));
        } else {
            return false;
        }
    }

    public function extractActivitySource($activityBlock)
    {
        $key = 'source:';

        $keyPosition = strpos($activityBlock, "\n".$key) + 1;
        $offset = $keyPosition + strlen($key);
        if ((false !== $keyPosition) and ($offset < strlen($activityBlock))) {
            $endOfLine = strpos($activityBlock, "\n", $keyPosition);
            if (false === $endOfLine) {
                $endOfLine = strlen($activityBlock);
            }

            // identify the first non-whitespace after the key "source: "
            for ($start = $offset; $start <= $endOfLine; $start++) {
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

        return false;
    }

    /**
     * @param $activityBlock
     * @param $key
     * @return string
     */
    private function extractStringValue($activityBlock, $key)
    {
        $keyPosition = strpos($activityBlock, "\n".$key) + 1;
        $offset = $keyPosition + strlen($key);
        if ((false !== $keyPosition) and ($offset < strlen($activityBlock))) {
            $start = strpos($activityBlock, '"', $offset) + strlen('"');
            $end = strpos($activityBlock, '"', $start);

            return substr($activityBlock, $start, $end - $start);
        }

        return false;
    }
}