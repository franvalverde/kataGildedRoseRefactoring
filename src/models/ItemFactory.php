<?php

declare(strict_types=1);

namespace GildedRose\models;

final class ItemFactory extends Item
{
    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const CONJURED = 'Conjured';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    private $name;
    private $sell_in;
    private $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function init()
    {
        switch ($this->name) {
            case self::AGED_BRIE:
                return new AgedBrie($this->name, $this->sell_in, $this->quality);
            case self::BACKSTAGE_PASSES:
                return new Backstage($this->name, $this->sell_in, $this->quality);
            case self::CONJURED:
                return new Conjured($this->name, $this->sell_in, $this->quality);
            case self::SULFURAS:
                return new Sulfura($this->name, $this->sell_in, $this->quality);
            default:
                return new StandardItem($this->name, $this->sell_in, $this->quality);
        }
    }

}
