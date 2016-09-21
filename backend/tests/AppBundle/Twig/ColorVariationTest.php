<?php

namespace tests\AppBundle\Twig;

use AppBundle\Twig\ColorVariation;

class ColorVariationTest extends \PHPUnit_Framework_TestCase
{
    public function testNextColor()
    {
        $colorVariation = new ColorVariation();

        $colorCode = $colorVariation->nextColor();
        for($i = 1; $i < 100; $i++) {
            $previousColorCode = $colorCode;
            $colorCode = $colorVariation->nextColor();

            $this->assertNotEquals($colorCode, $previousColorCode, 'In iteration ' . $i . '.');
        }
    }
}
