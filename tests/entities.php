<?php

declare(strict_types=1);

use Kommai\Model\EntityInterface;
use Kommai\Model\EntityTrait;

class Item implements EntityInterface
{
    use EntityTrait;

    public string $name = '';
    public int $value = 0;

    public function fromArray(array $data): self
    {
        $this->id = (int) $data['id'];
        $this->name = $data['name'];
        $this->value = (int) $data['value'];
        return $this;
    }
}

class ItemOwner implements EntityInterface
{
    use EntityTrait;

    public ?int $itemId = null;
    public string $name = '';

    public function fromArray(array $data): self
    {
        $this->id = (int) $data['id'];
        $this->itemId = (int) $data['item'];
        $this->name = $data['name'];
        return $this;
    }

    public function toArray(): array
    {
        $data = get_object_vars($this);
        unset($data['itemId']);
        $data['item'] = $this->itemId;
        return $data;
    }
}
