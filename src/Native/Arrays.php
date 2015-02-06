<?php

namespace Mysidia\Resource\Native;

use ArrayIterator;
use InvalidArgumentException;
use Mysidia\Resource\Cloneable;
use Mysidia\Resource\Comparable;
use Mysidia\Resource\Hashable;
use Mysidia\Resource\Invokable;
use Mysidia\Resource\Stringable;
use Mysidia\Resource\Valuable;
use Serializable;
use SplFixedArray;

/**
 * An array abstraction
 *
 * @author Ordland
 */
final class Arrays extends SplFixedArray implements Cloneable, Comparable, Hashable, Invokable, Stringable, Valuable, Serializable
{
    /**
     * {@inheritdoc}
     */
    public function equals($array)
    {
        if (!($array instanceof Arrays)) {
            throw new InvalidArgumentException("Argument array must be an instance of Arrays");
        }

        return ($this->length() == $array->length());
    }

    /**
     * {@inheritdoc}
     */
    public function hash()
    {
        return spl_object_hash($this);
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
        return unserialize(serialize($this));
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([$this->length(), $this->value()]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($string)
    {
        list($length, $value) = unserialize($string);

        $this->setSize($length);
        $this->fill($value);
    }

    /**
     * @param array $items
     *
     * @return $this
     */
    public function fill(array $items)
    {
        foreach ($items as $i => $item) {
            $this[$i] = $item;
        }

        return $this;
    }

    /**
     * Returns the size of the array
     *
     * @return int
     */
    public function length()
    {
        return $this->count();
    }

    /**
     * Returns an ArrayIterator for this array
     *
     * @return ArrayIterator
     */
    public function iterator()
    {
        return new ArrayIterator($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return get_class($this)."(".$this->count().")";
    }

    /**
     * {@inheritdoc}
     */
    public function compareTo(Valuable $object)
    {
        if (!($object instanceof Arrays)) {
            throw new InvalidArgumentException("Argument array must be an instance of Arrays");
        }

        $a = $this->length();
        $b = $object->length();

        return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
    }

    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke()
    {
        return $this->toArray();
    }
}
