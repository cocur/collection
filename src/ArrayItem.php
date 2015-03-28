<?php

namespace Cocur\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use OutOfBoundsException;

/**
 * ArrayItem
 *
 * @package   Cocur\Collection
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 */
class ArrayItem extends AbstractItem implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $data
     *
     * @return ArrayItem
     */
    public static function createFromArray(array $data = [])
    {
        $item = new self();
        $item->data = $data;

        return $item;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return ArrayItem
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param mixed $key
     *
     * @return mixed
     *
     * @throws OutOfBoundsException if $key does not exist in the array
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new OutOfBoundsException(sprintf('This ArrayItem has no element with key "%s".', $key));
        }

        return $this->data[$key];
    }

    /**
     * @param mixed $key
     *
     * @return ArrayItem
     *
     * @throws OutOfBoundsException if $key does not exist in the array
     */
    public function remove($key)
    {
        if (!$this->has($key)) {
            throw new OutOfBoundsException(sprintf('This ArrayItem has no element with key "%s".', $key));
        }

        unset($this->data[$key]);

        return $this;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     *
     * @throws OutOfBoundsException if $key does not exist in the array
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     *
     * @return void
     *
     * @throws OutOfBoundsException if $key does not exist in the array
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}
