<?php
declare(strict_types = 1);

namespace AppBundle\Importer\Activity;

class ActivityReader
{
    private $activities;

    private $activityFileNames = [];

    private $currentLocale;

    public function __construct(string $fileName = null, array $activityFileNames = null, $defaultLocale = 'en')
    {
        if ($activityFileNames) {
            $this->activityFileNames = $activityFileNames;
            $this->currentLocale = $defaultLocale;
            $fileName = $this->activityFileNames[$this->currentLocale];
        };
        $this->readActivities($fileName);
    }

    public function extractAllActivities()
    {
        $activity = [];

        for ($i = 1; $i <= $this->highestRetromatId(); $i++) {
            $activity[$i] = $this->extractActivity($i);
        }

        return $activity;
    }

    public function highestRetromatId()
    {
        $key = 'all_activities[';
        $keyPosition = strrpos($this->activities, "\n".$key) + 1;

        $start = $keyPosition + strlen($key);
        $end = strpos($this->activities, ']', $start);

        // $retromatId is the public ID as in https://retromat.org/?id=123
        // $jsArrayId is the interal ID as in lang/activities_en.php all_activities[122]
        $highestJsArrayId = intval(trim(substr($this->activities, $start, $end - $start)));
        $highestRetromatId = $highestJsArrayId + 1;

        return $highestRetromatId;
    }

    public function extractActivity($retromatId)
    {
        $activityBlock = $this->extractActivityBlock($retromatId);

        $activity = [
            'retromatId' => $retromatId,
            'phase' => $this->extractActivityPhase($activityBlock),
            'name' => $this->extractActivityName($activityBlock),
            'summary' => $this->extractActivitySummary($activityBlock),
            'desc' => $this->extractActivityDescription($activityBlock),
            'source' => $this->extractActivitySource($activityBlock),
            'more' => $this->extractActivityMore($activityBlock),
            'duration' => $this->extractActivityDuration($activityBlock),
            'stage' => $this->extractActivityStage($activityBlock),
            'suitable' => $this->extractActivitySuitable($activityBlock),
        ];

        return $activity;
    }

    private function extractActivityBlock($retromatId)
    {
        // $retromatId is the public ID as in https://retromat.org/?id=123
        // $jsArrayId is the interal ID as in lang/activities_en.php all_activities[122]
        $jsArrayId = $retromatId - 1;

        $startMarker = "{\n";
        $endMarker = "\n};";

        $blockStart = strpos($this->activities, 'all_activities['.$jsArrayId.']');
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
        $description = $this->extractStringValue($activityBlock, $key = 'desc:');
        if (empty($description)) {
            return null;
        } else {
            return str_replace(["<a href='", "'>", "\\\n"], ['<a href="', '">', ''], $description);
        }
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

    public function extractActivityStage($activityBlock)
    {
        return $this->extractStringValue($activityBlock, $key = 'stage:');
    }

    public function extractActivityPhase($activityBlock)
    {
        $key = 'phase:';

        if (0 === strpos($activityBlock, $key)) {
            $start = strlen($key);
            $end = strpos($activityBlock, ',', $start);

            return intval(trim(substr($activityBlock, $start, $end - $start)));
        } else {
            return null;
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

        return null;
    }

    /**
     * @param $activityBlock
     * @param $key
     * @return string
     */
    private function extractStringValue($activityBlock, $key)
    {
        $keyPosition = strpos($activityBlock, "\n".$key);
        $offset = $keyPosition + 1 + strlen($key); // +1 to compensate for linebreak ("\n") that was prepended
        if ((false !== $keyPosition) and ($offset < strlen($activityBlock))) {
            $start = strpos($activityBlock, '"', $offset) + strlen('"');
            $end = strpos($activityBlock, '"', $start);

            return substr($activityBlock, $start, $end - $start);
        }

        return null;
    }

    /**
     * @param string $fileName
     */
    private function readActivities(string $fileName): void
    {
        $this->activities = file_get_contents($fileName);
    }

    /**
     * @param string $currentLocale
     * @return ActivityReader
     */
    public function setCurrentLocale(string $currentLocale): ActivityReader
    {
        $this->currentLocale = $currentLocale;
        $this->readActivities($this->activityFileNames[$this->currentLocale]);

        return $this;
    }
}