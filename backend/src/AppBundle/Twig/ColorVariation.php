<?php

namespace AppBundle\Twig;

class ColorVariation
{
    private $colors;
    private $previousColor = -1;
    private $allColors = [0, 1, 2, 3, 4];

    public function nextColor()
    {
        if (count($this->colors) < 2){
            $this->colors = $this->allColors;
            shuffle($this->colors);
        }

        $color = array_pop($this->colors);
        if ($color == $this->previousColor) {
            $color = array_pop($this->colors);
        }

        $this->previousColor = $color;

        return $color;
    }
}