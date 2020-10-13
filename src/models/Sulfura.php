<?php

declare(strict_types=1);

namespace GildedRose\models;

final class Sulfura extends Item
{
    public function __construct(string $name, int $sell_in, int $quality)
    {
        parent::__construct($name, $sell_in, $quality);
    }

    public function update(): void
    {
        //nothing to do
    }
}
