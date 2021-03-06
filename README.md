Cocur\Collection
================

> Arrays are great, but sometimes the items need to know the thing they are a part of. Then you need a `Collection`.

[![Build Status](https://img.shields.io/travis/cocur/collection/master.svg?style=flat)](https://travis-ci.org/cocur/collection)
[![Windows Build status](https://ci.appveyor.com/api/projects/status/8vnaaxv3kabkb42j?svg=true)](https://ci.appveyor.com/project/florianeckerstorfer/collection)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/cocur/collection.svg?style=flat)](https://scrutinizer-ci.com/g/cocur/collection/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/cocur/collection.svg?style=flat)](https://scrutinizer-ci.com/g/cocur/collection/?branch=master)
[![StyleCI](https://styleci.io/repos/32883978/shield)](https://styleci.io/repos/32883978)

Developed by [Florian Eckerstorfer](https://florian.ec) ([Twitter](https://twitter.com/Florian_)) in Vienna, Europe.


Installation
------------

```shell
$ composer require cocur/collection
```


Usage
-----

The most important part of Collection are it's interfaces. They make your collection interoperable with other
libraries. However, this library also contains implementations that are ready to use.

### Interfaces

- [`CollectionInterface`](#collectioninterface)
- [`ItemInterface`](#iteminterface)

### Implementations

- [`Collection`](#collection)
- [`AbstractItem`](#abstractitem)
- [`Item`](#item)
- [`ArrayItem`](#arrayitem)

### CollectionInterface

`Cocur\Collection\CollectionInterface` defines the basic methods of a collection and extends
`IteratorAggregate` and `Countable`.

```php
Cocur\Collection\CollectionInterface add(ItemInterface $item)
```

When calling `add()` the collection should call the `setCollection()` method of the item and set itself as its
collection.

```php
Iterator getIterator()
```

Should return an iterator to iterate through the items of the collection.

```php
int count()
```

Should return the number of items in the collection.

### ItemInterface

`Cocur\Collection\ItemInterface` defines two methods: `setCollection()` and `getCollection()`.

```php
ItemInterface setCollection(CollectionInterface $collection)
```

Should store a reference to the collection in the item.

```php
CollectionInterface|null getCollection()
```

Should return a reference to the collection or `null` if the item does not have a collection.

### Collection

`Cocur\Collection\Collection` implements `Cocur\Collection\CollectionInterface` and uses a simple array to keep track
of its items.

### AbstractItem

`Cocur\Collection\AbstractItem` implements the methods from `Cocur\Collection\ItemInterface`. It simply sets and gets
the collection and is great if you don't need a specific logic on how to set and get the collection on an item.

`AbstractItem` is, as its name suggests, an abstract class and you need to extend it.

### Item

`Cocur\Collection\Item` extends `Cocur\Collection\AbstractItem` and in addition to the `setCollection()` and
`getCollection()` methods also implements `setValue()` and `getValue()` to set and get an arbitrary value. You can wrap
`Item` around a scalar value or around an object that is out of your control and does not implement `ItemInterface`.

```php
Item setValue(mixed $value)
mixed getValue()
```

In addition `Cocur\Collection\Item` has a factory method called `::create()`:

```php
Item create(mixed $value = null)
```

### ArrayItem

While `Item` stores a single value, `Cocur\Collection\ArrayItem` is meant to hold an array. It implements methods to
set, get and remove elements from the item as well as to check for their existence. In addition the `toArray()` method
returns the underlying array.

```php
ArrayItem set(mixed $key, mixed $value)
bool has(mixed $key)
mixed get(mixed $key[, mixed $defaultValue])
ArrayItem remove(mixed $key()
array toArray()
```

The `get()` and `remove()` methods throw an `OutOfBoundsException` if the element with the given key does not exist.
However, instead of throwing an exception `get()` can also return a default value if one is provided as second
argument.

You can create new instances using the static `::createFromArray()` method:

```php
ArrayItem createFromArray(array $data = [])
```

Because `ArrayItem` implements `ArrayAccess`, `IteratorAggregate` and `Countable` you can use it in most cases just
like you would use an array.

```php
$item = ArrayItem::createFromArray(['foo' => 'bar');
$item['qoo'] = 'qoz';
echo count($item); // -> 2
if (isset($item['qoo'])) {
    echo $item['qoo']; // -> "qoz"
}

foreach ($item as $key => $value) {
    echo "$key: $value, ";
}
// -> "foo: bar, qoo: qoz, "
```


Change Log
----------

### Version 0.1.1 (18 May 2015)

- Add option default value to `ArrayItem::get()`

### Version 0.1 (28 April 2015)

- Initial release


License
-------

The MIT license applies to cocur/collection. For the full copyright and license information, please view the
[LICENSE](https://github.com/cocur/collection/blob/master/LICENSE) file distributed with this source code.
