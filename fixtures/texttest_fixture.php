<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\models\ItemFactory;

echo "OMGHAI!" . PHP_EOL;

$items = array(
    (new ItemFactory('+5 Dexterity Vest', 10, 20))->init(),
    (new ItemFactory('Aged Brie', 2, 0))->init(),
    (new ItemFactory('Elixir of the Mongoose', 5, 7))->init(),
    (new ItemFactory('Sulfuras, Hand of Ragnaros', 0, 80))->init(),
    (new ItemFactory('Sulfuras, Hand of Ragnaros', -1, 80))->init(),
    (new ItemFactory('Backstage passes to a TAFKAL80ETC concert', 15, 20))->init(),
    (new ItemFactory('Backstage passes to a TAFKAL80ETC concert', 10, 49))->init(),
    (new ItemFactory('Backstage passes to a TAFKAL80ETC concert', 5, 49))->init(),
    (new ItemFactory('Conjured Mana Cake', 3, 6))->init()
);

$app = new GildedRose($items);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo("-------- day $i --------" . PHP_EOL);
    echo("name, sellIn, quality" . PHP_EOL);
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
