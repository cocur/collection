<?php

namespace Cocur\Collection;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * CollectionTest
 *
 * @package   Cocur\Collection
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 * @group     unit
 */
class CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Collection
     */
    private $collection;

    public function setUp()
    {
        $this->collection = new Collection();
    }

    /**
     * @test
     * @covers Cocur\Collection\Collection::add()
     */
    public function addAddsItemToCollection()
    {
        $item = $this->getMockItem();
        $item->shouldReceive('setCollection')->with($this->collection)->once();
        $this->collection->add($item);

        $this->assertContains($item, $this->collection);
    }

    /**
     * @test
     * @covers Cocur\Collection\Collection::getIterator()
     */
    public function getIteratorReturnsIterator()
    {
        $item = $this->getMockItem();
        $item->shouldReceive('setCollection')->with($this->collection)->once();
        $this->collection->add($item);
        $iterator = $this->collection->getIterator();

        $this->assertInstanceOf('Iterator', $iterator);
        $this->assertSame($item, current($iterator));
    }

    /**
     * @test
     * @covers Cocur\Collection\Collection::count()
     */
    public function countReturnsNumberOfItems()
    {
        $item = $this->getMockItem();
        $item->shouldReceive('setCollection')->with($this->collection)->once();
        $this->collection->add($item);
        $this->collection->add($item);

        $this->assertCount(2, $this->collection);
    }

    /**
     * @return Mockery\MockInterface|\Cocur\Collection\ItemInterface
     */
    protected function getMockItem()
    {
        return Mockery::mock('Cocur\Collection\ItemInterface');
    }
}
