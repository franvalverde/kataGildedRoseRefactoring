<?php

declare(strict_types=1);

namespace GildedRose\models;

final class StandardItem extends Item
{
    const MIN_QUALITY = 0;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        parent::__construct($name, $sell_in, $quality);
    }

    public function update(): void
    {
        if ($this->getQuality() > self::MIN_QUALITY) {
            $this->setQuality($this->getQuality() - 1);
        }
        $this->decreaseSellIn();
        if ($this->getSellIn() < 0 && $this->getQuality() > self::MIN_QUALITY) {
            $this->setQuality($this->getQuality() - 1);
        }
    }
}
