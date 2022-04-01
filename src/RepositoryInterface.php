<?php

declare(strict_types=1);

namespace Kommai\Model;

use Generator;

interface RepositoryInterface
{
    public function add(EntityInterface $entity): EntityInterface;
    public function delete(EntityInterface $entity): void;
    public function findAll(): Generator;
    public function findById(int $id): ?EntityInterface;
    public function has(EntityInterface $entity): bool;
    public function update(EntityInterface $entity): EntityInterface;
}
