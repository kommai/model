<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/entities.php';
require_once __DIR__ . '/repositories.php';

$pdo = require_once __DIR__ . '/pdo.php';

$itemRepository = new ItemRepository($pdo, 'items');
//var_dump($itemRepository);

$item = $itemRepository->findById(1);
$itemRepository->delete($item);
//$itemRepository->delete(new Item());

$itemToAdd = (new Item())->fromArray([
    'id' => 123,
    'name' => 'Example item',
    'value' => 999,
]);
$itemAdded = $itemRepository->add($itemToAdd);
var_dump($itemAdded, $itemAdded === $itemToAdd);

$itemAdded->name = 'Now it\'s free!';
$itemAdded->value = 0;

//var_dump($itemRepository->update($itemAdded));

//var_dump(iterator_to_array($itemRepository->findAll()));
//var_dump($itemRepository->findById(1));
