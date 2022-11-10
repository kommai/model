<?php

declare(strict_types=1);

namespace Kommai\Model;

use Generator;
use LogicException;
use PDO;
use PDOException;
use RuntimeException;

trait RepositoryTrait
{
    private PDO $pdo;
    public string $table; // readonly
    private array $repositories;

    public function __construct(PDO $pdo, string $table, RepositoryInterface ...$repositories)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->table = $table;
        $this->repositories = $repositories;
    }

    public function add(EntityInterface $entity): EntityInterface
    {
        try {
            $data = $entity->toArray();
            unset($data['id']);
            $statement = $this->pdo->prepare(sprintf(
                'INSERT INTO `%s` (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($data)),
                implode(', ', array_map(fn ($key) => sprintf(':%s', $key), array_keys($data))),
            ));
            $statement->execute($data);
            return $this->findById((int) $this->pdo->lastInsertId());
        } catch (PDOException $thrown) {
            throw new RuntimeException('Failed to add the entity', 0, $thrown);
        }
    }

    public function delete(EntityInterface $entity): void
    {
        if (!$this->has($entity)) {
            throw new LogicException('Cannot delete an unsaved entity');
        }
        try {
            $statement = $this->pdo->prepare(sprintf('DELETE FROM `%s` WHERE `id` = :id', $this->table));
            $statement->execute(['id' => $entity->id]);
        } catch (PDOException $thrown) {
            throw new RuntimeException('Failed to delete the entity', 0, $thrown);
        }
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
            $statement = $this->pdo->prepare(sprintf('SELECT * FROM `%s` WHERE `id` = :id', $this->table));
            $statement->execute(['id' => $id]);
            $data = $statement->fetch();
            return $data ? self::createEntity()->fromArray($data) : null;
        } catch (PDOException $thrown) {
            throw new RuntimeException('Failed to find an entity', 0, $thrown);
        }
    }

    public function has(EntityInterface $entity): bool
    {
        if (!isset($entity->id)) {
            return false;
        }
        return $this->findById($entity->id) instanceof EntityInterface;
    }


    public function update(EntityInterface $entity): EntityInterface
    {
        if (!$this->has($entity)) {
            throw new LogicException('Cannot update an unsaved entity');
        }
        try {
            $data = $entity->toArray();
            unset($data['id']);
            $statement = $this->pdo->prepare(sprintf(
                'UPDATE `%s` SET %s WHERE `id` = :id',
                $this->table,
                implode(', ', array_map(fn ($key) => sprintf('`%s` = :%s', $key, $key), array_keys($data)))
            ));
            $statement->execute(array_merge($data, ['id' => $entity->id]));
            return $entity;
        } catch (PDOException $thrown) {
            throw new RuntimeException('Failed to update the entity', 0, $thrown);
        }
    }
}
