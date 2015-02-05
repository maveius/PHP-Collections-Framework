<?php

namespace Mysidia\Resource\Native;

use ArrayIterator;
use InvalidArgumentException;
use Mysidia\Resource\Cloneable;
use Mysidia\Resource\Comparable;
use Mysidia\Resource\Stringable;
use Mysidia\Resource\Valuable;
use Serializable;
use SplFixedArray;

/**
 * The Arrays Class, extending from SplFixedArray class.
 *
 * It defines how fixed sized numeric arrays are used in Mysidia Framework.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Arrays extends SplFixedArray implements Comparable, Cloneable, Serializable, Stringable, Valuable
{
    /**
     * {@inheritdoc}
     */
    public function equals($array)
    {
        if (!($array instanceof Arrays)) {
            throw new InvalidArgumentException("Argument array must be an instance of Arrays");
        }

        return ($this == $array);
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
        return serialize($this);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($string)
    {
        return unserialize($string);
    }

    /**
     * The length method, returns the size of the array in java way.
     *
     * @access public
     *
     * @return int
     */
    public function length()
    {
        return $this->count();
    }

    /**
     * The iterator method, retrieves an ArrayIterator for this Array.
     *
     * @access public
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
    public function getClassName()
    {
        return $this->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return get_class($this)."(".$this->length().")";
    }

    /**
     * {@inheritdoc}
     */
    public function compareTo(Valuable $object)
    {
        $a = $this->getValue();
        $b = $object->getValue();

        return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        return new String(get_class($this)."(".$this->length().")");
    }

    /**
     * {@inheritdoc}
     */
    public function string()
    {
        return $this->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function className()
    {
        return $this->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->getValue();
    }
}
