<?php

declare(strict_types=1);

namespace GildedRose\models;

final class Backstage extends Item
{
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;
    const BACKSTATE_PASSES_INCREASE_TWICE_QUALITY_SELLIN_THRESHOLD = 11;
    const BACKSTATE_PASSES_INCREASE_TRIPLE_QUALITY_SELLIN_THRESHOLD = 6;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        parent::__construct($name, $sell_in, $quality);
    }

    public function update(): void
    {
        $newQuality = $this->getQuality() + 1;
        if ($this->getSellIn() < self::BACKSTATE_PASSES_INCREASE_TWICE_QUALITY_SELLIN_THRESHOLD) {
            $newQuality++;
        }
        if ($this->getSellIn() < self::BACKSTATE_PASSES_INCREASE_TRIPLE_QUALITY_SELLIN_THRESHOLD) {
            $newQuality++;
        }
        $this->setQuality(($newQuality >= self::MAX_QUALITY) ? self::MAX_QUALITY : $newQuality);

        $this->decreaseSellIn();
        if ($this->getSellIn() < 0) {
            $this->setQuality(self::MIN_QUALITY);
        }
    }
}
