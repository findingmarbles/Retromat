<?php

namespace App\Tests\Twig;

use App\Model\Twig\ColorVariation;
use PHPUnit\Framework\TestCase;

class ColorVariationTest extends TestCase
{
    public function testNextColor()
    {
        $colorVariation = new ColorVariation();

        $colorCode = $colorVariation->nextColor();
        for ($i = 1; $i < 100; $i++) {
            $previousColorCode = $colorCode;
            $colorCode = $colorVariation->nextColor();

            $this->assertNotEquals($colorCode, $previousColorCode, 'In iteration '.$i.'.');
        }
    }
}
