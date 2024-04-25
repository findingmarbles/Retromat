<?php

namespace App\Tests\Utils;

use App\Twig\ColorVariationExtension;
use PHPUnit\Framework\TestCase;

final class ColorVariationExtensionTest extends TestCase
{
    public function testNextColor(): void
    {
        $colorVariationHelper = new ColorVariationExtension();

        $colorId = $colorVariationHelper->nextColor();
        for ($i = 1; $i < 100; ++$i) {
            $previousColorId = $colorId;
            $colorId = $colorVariationHelper->nextColor();

            $this->assertNotEquals($colorId, $previousColorId, 'In iteration '.$i.'.');
        }
    }
}
