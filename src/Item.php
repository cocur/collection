<?php

namespace Cocur\Collection;

/**
 * Item.
 *
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 */
class Item extends AbstractItem
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed|null $value
     *
     * @return Item
     */
    public static function create($value = null)
    {
        $item = new self();
        if ($value) {
            $item->setValue($value);
        }

        return $item;
    }

    /**
     * @param mixed $value
     *
     * @return Item
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
