<?php

namespace Mysidia\Resource\Native;

use Mysidia\Resource\Cloneable;
use Mysidia\Resource\Coercible;
use Mysidia\Resource\Comparable;
use Mysidia\Resource\Hashable;
use Mysidia\Resource\Invokable;
use Mysidia\Resource\Stringable;
use Mysidia\Resource\Valuable;
use Serializable;

/**
 * The Abstract Object Class, root of all Mysidia library files.
 *
 * Contrary to Java's Object root class, this one is abstract.
 *
 * For this reason, one cannot instantiate an object of this class.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @abstract
 */
abstract class Object implements Cloneable, Coercible, Comparable, Hashable, Invokable, Stringable, Valuable, Serializable
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * Constructor of Object Class, which simply serves as a marker for child
     * classes.
     *
     * @access public
     *
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->value = $this->coerce($value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        return $value;
    }

    /**
     * Destructor of Object Class, which simply serves as a marker for child
     * classes.
     *
     * @access public
     */
    public function __destruct()
    {
        $this->value = null;
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
    public function equals($object)
    {
        return ($this == $object);
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
    public function toString()
    {
        return new String(get_class($this));
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
    public function className()
    {
        return $this->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function hashCode()
    {
        return hexdec(spl_object_hash($this));
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
     * {@inheritdoc}
     */
    public function __toString()
    {
        return get_class($this);
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function value()
    {
        return $this->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke()
    {
        return $this->getValue();
    }
}
