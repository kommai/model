<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/entities.php';
require_once __DIR__ . '/repositories.php';

$pdo = require_once __DIR__ . '/pdo.php';

$itemOwnerRepository = new ItemOwnerRepository($pdo, 'item_owners');
$itemRepository = new ItemRepository($pdo, 'items');
//$itemRepository = new ItemRepository($pdo, 'items', $itemOwnerRepository);
var_dump($itemRepository);
