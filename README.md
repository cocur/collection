Cocur\Collection
================

> Arrays are great, but sometimes the items need to know the thing they are a part of. Then you need a `Collection`.

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
set, get and remove elements from the item as well as to check for their existence.

```php
ArrayItem set(mixed $key, mixed $value)
bool has(mixed $key)
mixed get(mixed $key)
ArrayItem remove(mixed $key()
```

The `get()` and `remove()` methods throw an `OutOfBoundsException` if the element with the given key does not exist.

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


Changelog
---------

*No version releases yet.*


License
-------
