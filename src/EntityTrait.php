<?php

declare(strict_types=1);

namespace Kommai\Model;

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
}
