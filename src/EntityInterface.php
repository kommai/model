<?php

declare(strict_types=1);

namespace Kommai\Model;

interface EntityInterface
{
    public function __serialize(): array;
    public function __unserialize(array $data): void;
    public function toArray(): array;
    public function fromArray(array $data): self;
}
