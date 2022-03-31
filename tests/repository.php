<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/entities.php';
require_once __DIR__ . '/repositories.php';

$pdo = require_once __DIR__ . '/pdo.php';

$itemRepository = new ItemRepository($pdo, 'items');
//var_dump($itemRepository);
var_dump(iterator_to_array($itemRepository->findAll()));
//var_dump($itemRepository->findById(1));
