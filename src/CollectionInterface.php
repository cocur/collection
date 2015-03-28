<?php

namespace Cocur\Collection;

use Countable;
use IteratorAggregate;

/**
 * CollectionInterface
 *
 * @package   Cocur\Collection
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 */
interface CollectionInterface extends IteratorAggregate, Countable
{
    /**
     * @param ItemInterface $item
     *
     * @return CollectionInterface
     */
    public function add(ItemInterface $item);
}
