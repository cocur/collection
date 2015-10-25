<?php

namespace Cocur\Collection;

use ArrayIterator;

/**
 * Collection.
 *
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer+
 */
class Collection implements CollectionInterface
{
    /**
     * @var ItemInterface[]
     */
    protected $items = [];

    /**
     * @param ItemInterface $item
     *
     * @return Collection
     */
    public function add(ItemInterface $item)
    {
        $item->setCollection($this);
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }
}
