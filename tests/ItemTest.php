<?php

namespace Cocur\Collection;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * ItemTest
 *
 * @package   Cocur\Collection
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 * @group     unit
 */
class ItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Item
     */
    private $item;

    public function setUp()
    {
        $this->item = new Item();
    }

    /**
     * @test
     * @covers Cocur\Collection\Item::setValue()
     * @covers Cocur\Collection\Item::getValue()
     */
    public function setValueSetsValueAndGetValueReturnsValue()
    {
        $this->item->setValue('foobar');

        $this->assertSame('foobar', $this->item->getValue());
    }

    /**
     * @test
     * @covers Cocur\Collection\Item::setCollection()
     * @covers Cocur\Collection\Item::getCollection()
     */
    public function setCollectionSetsCollectionAndGetCollectionReturnsCollection()
    {
        $collection = Mockery::mock('Cocur\Collection\CollectionInterface');
        $this->item->setCollection($collection);

        $this->assertSame($collection, $this->item->getCollection());
    }

    /**
     * @test
     * @covers Cocur\Collection\Item::create()
     */
    public function createCreatesItemWithValue()
    {
        $item = Item::create('foobar');

        $this->assertInstanceOf('Cocur\Collection\Item', $item);

        $this->assertSame('foobar', $item->getValue());
    }
}
