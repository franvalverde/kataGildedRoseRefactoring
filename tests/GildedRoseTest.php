<?php
declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testItShouldDegradeTheQualityTwiceWhenItExpires(): void
    {
        $items = [new Item('queso cabrales', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(8, $items[0]->quality);
    }

    public function testTheQualityOfAnItemIsNeverNegative(): void
    {
        $items = [new Item('quesito el caserio', 10, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testItShouldIncreasesInQualityTheOlderItGetsAgedBrie(): void
    {
        $items = [new Item('Aged Brie', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->quality);
    }

    public function testTheQualityItsNeverMoreThan50(): void
    {
        $items = [new Item('Queso Curado', 10, 60)];
        $this->assertSame(50, $items[0]->quality);
    }

    public function testTheQualityOfSulfurasMustBe80(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 90)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(80, $items[0]->quality);
    }

    public function testTheQualityOfSulfurasNeverDecrease(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(20, $items[0]->quality);
    }

    public function testTheQualityOfSulfurasNeverHasToBeSold(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(10, $items[0]->sell_in);
    }

    public function testItShouldIncreasesTheQualityOfBackstagePassesAsItsSellInValueApproaches(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 6, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(22, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(25, $items[0]->quality);
    }

    public function testItShouldDropTheQualityOfBackstagePassesAfterTheConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 6, 20)];
        $gildedRose = new GildedRose($items);
        while($items[0]->sell_in >= 0) {
            $gildedRose->updateQuality();
        }
        $this->assertSame(0, $items[0]->quality);
    }

    public function testItShouldDegradeInQualityTwiceAsNormalOfConjuredItem(): void
    {
        $items = [new Item('Conjured', 2, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(18, $items[0]->quality);
        while($items[0]->sell_in >= 0) {
            $gildedRose->updateQuality();
        }
        $this->assertSame(12, $items[0]->quality);
    }

}
