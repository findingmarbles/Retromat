<?php

namespace App\Twig;

use App\Utils\ColorVariationHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ColorVariationExtension extends AbstractExtension
{
    private $colors = [];

    private $previousColor = -1;

    private $allColors = [0, 1, 2, 3, 4];

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('nextRetromatColor', [$this, 'nextColor']),
        ];
    }

    public function nextColor(): int
    {
        if (\count($this->colors) < 2) {
            $this->colors = $this->allColors;
            \shuffle($this->colors);
        }

        $color = \array_pop($this->colors);
        if ($color == $this->previousColor) {
            $color = \array_pop($this->colors);
        }

        $this->previousColor = $color;

        return $color;
    }
}