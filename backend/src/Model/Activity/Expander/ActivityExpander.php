<?php

declare(strict_types=1);

namespace App\Model\Activity\Expander;

use App\Entity\Activity;

final class ActivityExpander
{
    private array $sources = [];

    public function __construct(array $sources)
    {
        $this->sources = $sources;
    }

    public function expandSource(Activity $activity): void
    {
        $activity->setSource($this->pruneSourceString($activity->getSource()));
    }

    private function pruneSourceString(string $source): string
    {
        $source = \str_replace([' + "', '" + '], '', $source);
        $source = \str_replace('"', '', $source);
        $source = \str_replace(["='", "'>"], ['="', '">'], $source);
        $source = \str_replace(\array_keys($this->sources), $this->sources, $source);

        return $source;
    }
}
