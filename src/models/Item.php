<?php

declare(strict_types=1);

namespace GildedRose\models;

abstract class Item
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $sell_in;

    /**
     * @var int
     */
    private $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $maxQuality = ($name == 'Sulfuras, Hand of Ragnaros') ? 80 : 50;
        $this->quality = ($quality > $maxQuality) ? $maxQuality : $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function setSellIn(int $sellIn): void
    {
        $this->sell_in = $sellIn;
    }

    public function getSellIn(): int
    {
        return $this->sell_in;
    }


    public function decreaseSellIn(): void
    {
        $this->setSellIn($this->getSellIn() - 1);
    }
}
