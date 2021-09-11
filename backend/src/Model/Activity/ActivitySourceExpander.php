<?php
declare(strict_types = 1);

namespace App\Model\Activity;

use App\Entity\Activity;

class ActivitySourceExpander
{
    private $sources = [];

    /**
     * ActivitySourceExpander constructor.
     * @param array $sources
     */
    public function __construct(array $sources)
    {
        $this->sources = $sources;
    }

    /**
     * @param Activity $activity
     */
    public function expandSource(Activity $activity)
    {
        $activity->setSource($this->expandSourceString($activity->getSource()));
    }

    /**
     * @param string $source
     * @return string
     */
    private function expandSourceString(string $source): string
    {
        $source = str_replace([' + "', '" + '], '', $source);
        $source = str_replace('"', '', $source);
        $source = str_replace(["='", "'>"], ['="', '">'], $source);
        $source = str_replace(array_keys($this->sources), $this->sources, $source);

        return $source;
    }
}
