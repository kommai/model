<?php

declare(strict_types=1);

use Kommai\Model\EntityInterface;
use Kommai\Model\RepositoryInterface;

class ItemRepository implements RepositoryInterface
{
    private PDO $pdo;
    private string $table;

    public function __construct(PDO $pdo, string $table)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->table = $table;
    }

    private static function createEntity(): Item
    {
        return new Item();
    }

    public function findAll(): Generator
    {
        try {
            $statement = $this->pdo->prepare(sprintf('SELECT * FROM `%s` ORDER BY `id` ASC', $this->table));
            $statement->execute();
            foreach ($statement->fetchAll() as $data) {
                yield self::createEntity()->fromArray($data);
            }
        } catch (PDOException $thrown) {
            throw new RuntimeException('Failed to find entities', 0, $thrown);
        }
    }

    public function findById(int $id): ?EntityInterface
    {
        try {
            $statement = $this->pdo->prepare(sprintf('SELECT * FROM `%s` WHERE `id` = ?', $this->table));
            $statement->execute([$id]);
            $data = $statement->fetch();
            return $data ? self::createEntity()->fromArray($data) : null;
        } catch (PDOException $thrown) {
            throw new RuntimeException('Failed to find an entity', 0, $thrown);
        }
    }

    // TODO: write these
    public function add(EntityInterface $entity): EntityInterface
    {
        return $entity;
    }

    public function update(EntityInterface $entity): EntityInterface
    {
        return $entity;
    }

    public function delete(EntityInterface $entity): void
    {
    }
}
