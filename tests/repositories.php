<?php

declare(strict_types=1);

use Kommai\Model\RepositoryInterface;
use Kommai\Model\RepositoryTrait;

class ItemRepository implements RepositoryInterface
{
    use RepositoryTrait;

    private static function createEntity(): Item
    {
        return new Item();
    }
}

class ItemOwnerRepository implements RepositoryInterface
{
    use RepositoryTrait;

    private static function createEntity(): ItemOwner
    {
        return new ItemOwner();
    }
}

class ItemRelationRepository implements RepositoryInterface
{
    use RepositoryTrait;

    /*
    private static function createEntity(): Item
    {
        return new Item();
    }
    */
}
