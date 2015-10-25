<?php

namespace Cocur\Collection;

/**
 * ItemInterface.
 *
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 */
interface ItemInterface
{
    /**
     * @param CollectionInterface $collection
     *
     * @return ItemInterface
     */
    public function setCollection(CollectionInterface $collection);

    /**
     * @return CollectionInterface
     */
    public function getCollection();
}
