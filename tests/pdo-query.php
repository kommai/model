<?php

declare(strict_types=1);

/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/pdo.php';

//$q = 'SELECT * FROM items';
$q = 'SELECT item_owners.name FROM item_owners INNER JOIN item_relations ON item_owners.id = item_relations.owner WHERE item_relations.item = 1';

foreach ($pdo->query($q, PDO::FETCH_ASSOC) as $data) {
    //var_dump($data);
    foreach ($data as $key => $value) {
        echo sprintf('%s: %s', $key, (string) $value), PHP_EOL;
    }
    echo '--------------------', PHP_EOL;
}
