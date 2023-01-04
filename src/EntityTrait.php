<?php

declare(strict_types=1);

namespace Kommai\Model;

use InvalidArgumentException;

trait EntityTrait
{
    public ?int $id = null;

    public function __serialize(): array
    {
        return $this->toArray();
    }

    public function __unserialize(array $data): void
    {
        $this->fromArray($data);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function compare(EntityInterface $entity): array
    {
        if ($this::class !== $entity::class) {
            throw new InvalidArgumentException('Entity of a different type');
        }

        $entityValues = get_object_vars($entity);
        $difference = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($value !== ($entityValues[$key] ?? null)) {
                $difference[] = $key;
            }
        }

        return $difference;
    }
}
