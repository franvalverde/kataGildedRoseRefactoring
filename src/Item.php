<?php

declare(strict_types=1);

namespace GildedRose;

final class Item
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $sell_in;

    /**
     * @var int
     */
    public $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->setQuality($name, $quality);
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    private function setQuality(string $name, int $quality): void
    {
        $maxQuality = ($name == 'Sulfuras, Hand of Ragnaros') ? 80 : 50;
        $this->quality = ($quality > $maxQuality) ? $maxQuality : $quality;
    }
}
