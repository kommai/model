<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/entities.php';

//$item = new Item();
$item = (new Item())->fromArray([
    'id' => 123,
    'name' => 'An item',
    'value' => 1000,
]);
//var_dump($item, $item->toArray());
//var_dump(unserialize(serialize($item)));

$itemA = clone $item;
//$itemB = new ItemOwner();
$itemB = clone $itemA;
//$itemB->id = 0;
$itemB->name = '[MODIFIED]';
$itemB->value = 1000;

var_dump($itemA->compare($itemB));