<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\models\Item;

final class GildedRose
{
    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const CONJURED = 'Conjured';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;
    const BACKSTATE_PASSES_INCREASE_TWICE_QUALITY_SELLIN_THRESHOLD = 11;
    const BACKSTATE_PASSES_INCREASE_TRIPLE_QUALITY_SELLIN_THRESHOLD = 6;

    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->getName()) {
                case self::AGED_BRIE:
                    $this->updateAgedBrie($item);
                    break;
                case self::BACKSTAGE_PASSES:
                    $this->updateBackstagePasses($item);
                    break;
                case self::SULFURAS:
                    break;
                case self::CONJURED:
                    $this->updateConjured($item);
                    break;
                default:
                    $this->updateDefaultItem($item);
                    break;
            }
        }
    }

    private function updateAgedBrie(Item $item): void
    {
        if ($item->getQuality() < self::MAX_QUALITY) {
            $item->setQuality($item->getQuality() + 1);
        }
        $this->decreaseSellIn($item);
        if ($item->getSellIn() < 0 && $item->getQuality() < self::MAX_QUALITY) {
            $item->setQuality($item->getQuality() + 1);
        }
    }

    private function updateBackstagePasses(Item $item): void
    {
        $newQuality = $item->getQuality() + 1;
        if ($item->getSellIn() < self::BACKSTATE_PASSES_INCREASE_TWICE_QUALITY_SELLIN_THRESHOLD) {
            $newQuality++;
        }
        if ($item->getSellIn() < self::BACKSTATE_PASSES_INCREASE_TRIPLE_QUALITY_SELLIN_THRESHOLD) {
            $newQuality++;
        }
        $item->setQuality(($newQuality >= self::MAX_QUALITY) ? self::MAX_QUALITY : $newQuality);

        $this->decreaseSellIn($item);
        if ($item->getSellIn() < 0) {
            $item->setQuality(self::MIN_QUALITY);
        }
    }

    private function updateConjured(Item $item): void
    {
        $newQuality = $item->getQuality() - 2;
        $item->setQuality(($newQuality < self::MIN_QUALITY) ? self::MIN_QUALITY : $newQuality);
        $this->decreaseSellIn($item);
        if ($item->getSellIn() < 0 && $item->getQuality() > self::MIN_QUALITY) {
            $item->setQuality($item->getQuality() - 2);
        }
    }

    private function updateDefaultItem(Item $item): void
    {
        if ($item->getQuality() > self::MIN_QUALITY) {
            $item->setQuality($item->getQuality() - 1);
        }
        $this->decreaseSellIn($item);
        if ($item->getSellIn() < 0 && $item->getQuality() > self::MIN_QUALITY) {
            $item->setQuality($item->getQuality() - 1);
        }
    }

    private function decreaseSellIn(Item $item): void
    {
        $item->setSellIn($item->getSellIn() - 1);
    }
}
