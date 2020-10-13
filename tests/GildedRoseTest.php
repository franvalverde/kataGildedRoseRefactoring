<?php
declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\models\ItemFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [(new ItemFactory('foo', 0, 0))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->getName());
    }

    public function testItShouldDegradeTheQualityTwiceWhenItExpires(): void
    {
        $items = [(new ItemFactory('queso cabrales', 0, 10))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(8, $items[0]->getQuality());
    }

    public function testTheQualityOfAnItemIsNeverNegative(): void
    {
        $items = [(new ItemFactory('quesito el caserio', 10, 0))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->getQuality());
    }

    public function testItShouldIncreasesInQualityTheOlderItGetsAgedBrie(): void
    {
        $items = [(new ItemFactory('Aged Brie', 10, 10))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->getQuality());
    }

    public function testTheQualityItsNeverMoreThan50(): void
    {
        $items = [(new ItemFactory('Queso Curado', 10, 60))->init()];
        $this->assertSame(50, $items[0]->getQuality());
    }

    public function testTheQualityOfSulfurasMustBe80(): void
    {
        $items = [(new ItemFactory('Sulfuras, Hand of Ragnaros', 10, 90))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(80, $items[0]->getQuality());
    }

    public function testTheQualityOfSulfurasNeverDecrease(): void
    {
        $items = [(new ItemFactory('Sulfuras, Hand of Ragnaros', 10, 20))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(20, $items[0]->getQuality());
    }

    public function testTheQualityOfSulfurasNeverHasToBeSold(): void
    {
        $items = [(new ItemFactory('Sulfuras, Hand of Ragnaros', 10, 20))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(10, $items[0]->getSellIn());
    }

    public function testItShouldIncreasesTheQualityOfBackstagePassesAsItsSellInValueApproaches(): void
    {
        $items = [(new ItemFactory('Backstage passes to a TAFKAL80ETC concert', 6, 20))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(22, $items[0]->getQuality());
        $gildedRose->updateQuality();
        $this->assertSame(25, $items[0]->getQuality());
    }

    public function testItShouldDropTheQualityOfBackstagePassesAfterTheConcert(): void
    {
        $items = [(new ItemFactory('Backstage passes to a TAFKAL80ETC concert', 6, 20))->init()];
        $gildedRose = new GildedRose($items);
        while($items[0]->getSellIn() >= 0) {
            $gildedRose->updateQuality();
        }
        $this->assertSame(0, $items[0]->getQuality());
    }

    public function testItShouldDegradeInQualityTwiceAsNormalOfConjuredItem(): void
    {
        $items = [(new ItemFactory('Conjured', 2, 20))->init()];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(18, $items[0]->getQuality());
        while($items[0]->getSellIn() >= 0) {
            $gildedRose->updateQuality();
        }
        $this->assertSame(12, $items[0]->getQuality());
    }

}
