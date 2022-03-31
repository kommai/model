<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/entities.php';
require_once __DIR__ . '/repositories.php';

$pdo = require_once __DIR__ . '/pdo.php';

$entity = (new Item())->fromArray([
    'id' => 123,
    'name' => 'Example item',
    'value' => 999,
]);

// SET `col_name1` = ?, `col_name2` = ?
// `col_name1` = ?

/*
var_dump(array_map(function ($key) {
    return sprintf('`%s` = ?', $key);
}, array_keys($entity->toArray())));
*/
$c = implode(', ', array_map(fn ($key) => sprintf('`%s` = ?', $key), array_keys($entity->toArray())));
//var_dump($c);
$q = sprintf('UPDATE `table` SET %s WHERE `id` = ?', $c);
var_dump($q);
