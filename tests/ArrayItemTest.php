<?php

namespace Cocur\Collection;

use OutOfBoundsException;
use PHPUnit_Framework_TestCase;

/**
 * ArrayItemTest
 *
 * @package   Cocur\Collection
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 * @group     unit
 */
class ArrayItemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayItem
     */
    private $item;

    public function setUp()
    {
        $this->item = new ArrayItem();
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::set()
     * @covers Cocur\Collection\ArrayItem::get()
     */
    public function setSetsElementAndGetReturnsElement()
    {
        $this->item->set('foo', 'bar');

        $this->assertSame('bar', $this->item->get('foo'));
    }

    /**
     * @test
     * @covers                   Cocur\Collection\ArrayItem::get()
     * @expectedException        OutOfBoundsException
     * @expectedExceptionMessage This ArrayItem has no element with key "invalid".
     */
    public function getThrowsExceptionIfElementDoesNotExist()
    {
        $this->item->get('invalid');
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::has()
     */
    public function hasReturnsTrueIfElementExists()
    {
        $this->item->set('foo', 'bar');

        $this->assertTrue($this->item->has('foo'));
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::has()
     */
    public function hasReturnsTrueIfElementExistsButIsNull()
    {
        $this->item->set('foo', null);

        $this->assertTrue($this->item->has('foo'));
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::has()
     */
    public function hasReturnsFalseIfElementDoesNotExist()
    {
        $this->assertFalse($this->item->has('invalid'));
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::remove()
     */
    public function removeRemovesElementFromItem()
    {
        $this->item->set('foo', 'bar');
        $this->item->remove('foo');

        $this->assertFalse($this->item->has('foo'));
    }

    /**
     * @test
     * @covers                   Cocur\Collection\ArrayItem::remove()
     * @expectedException        OutOfBoundsException
     * @expectedExceptionMessage This ArrayItem has no element with key "invalid".
     */
    public function removeThrowsExceptionIfElementDoesNotExist()
    {
        $this->item->remove('invalid');
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::offsetExists()
     * @covers Cocur\Collection\ArrayItem::offsetGet()
     * @covers Cocur\Collection\ArrayItem::offsetSet()
     * @covers Cocur\Collection\ArrayItem::offsetUnset()
     */
    public function arrayItemAllowsArrayAccess()
    {
        $this->item['foo'] = 'bar'; // offsetSet()
        $this->assertTrue(isset($this->item['foo'])); // offsetExists()
        $this->assertSame('bar', $this->item['foo']); // offsetGet()
        unset($this->item['foo']); // offsetUnset()
        $this->assertFalse(isset($this->item['foo'])); // offsetExists()
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::count()
     */
    public function countReturnsTheNumberOfElementsInTheItem()
    {
        $this->item->set('foo', 'bar');
        $this->item->set('bar', 'foo');

        $this->assertCount(2, $this->item);
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::getIterator()
     */
    public function getIteratorReturnsArrayIterator()
    {
        $this->item->set('foo', 'bar');
        $iterator = $this->item->getIterator();

        $this->assertInstanceOf('ArrayIterator', $iterator);
        foreach ($this->item as $key => $value) {
            $this->assertSame('foo', $key);
            $this->assertSame('bar', $value);
        }
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::toArray()
     */
    public function toArrayReturnsArray()
    {
        $this->item->set('foo', 'bar');

        $this->assertSame(['foo' => 'bar'], $this->item->toArray());
    }

    /**
     * @test
     * @covers Cocur\Collection\ArrayItem::createFromArray()
     */
    public function createFromArrayReturnsNewInstance()
    {
        $item = ArrayItem::createFromArray(['foo' => 'bar']);

        $this->assertSame('bar', $item['foo']);
    }
}
