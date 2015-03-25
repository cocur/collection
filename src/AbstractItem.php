<?php

namespace Cocur\Collection;

/**
 * Item
 *
 * @package   Cocur\Collection
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 */
abstract class AbstractItem implements ItemInterface
{
    /**
     * @var CollectionInterface
     */
    protected $collection;

    /**
     * @param CollectionInterface $collection
     *
     * @return ItemInterface
     */
    public function setCollection(CollectionInterface $collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return CollectionInterface
     */
    public function getCollection()
    {
        return $this->collection;
    }
}
