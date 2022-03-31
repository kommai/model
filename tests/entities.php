<?php

declare(strict_types=1);

use Kommai\Model\EntityInterface;
use Kommai\Model\EntityTrait;

class Item implements EntityInterface
{
    use EntityTrait;

    //public ?int $id = null;
    public string $name = '';
    public int $value = 0;

    public function fromArray(array $data): self
    {
        $this->id = (int) $data['id'];
        $this->name = $data['name'];
        $this->value = (int) $data['value'];
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}

