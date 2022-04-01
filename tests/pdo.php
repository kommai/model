<?php

declare(strict_types=1);

$pdo = new PDO('sqlite::memory:');

$pdo->query('CREATE TABLE items (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `name` TEXT, `value` TEXT)');
$statement = $pdo->prepare('INSERT INTO `items` VALUES (NULL, ?, ?)');
$statement->execute(['Raspberry PI', 12920]);
$statement->execute(['Khadas', 9560]);
$statement->execute(['LattePanda', 18119]);

$pdo->query('CREATE TABLE item_owners (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `item` INTEGER, `name` TEXT)');
$statement = $pdo->prepare('INSERT INTO `item_owners` VALUES (NULL, ?, ?)');
$statement->execute([1, 'Alice']);
$statement->execute([2, 'Bob']);

return $pdo;