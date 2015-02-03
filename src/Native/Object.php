<?php

namespace Mysidia\Resource\Native;

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
abstract class Object implements Objective
{
    /**
     * Constructor of Object Class, which simply serves as a marker for child
     * classes.
     *
     * @access public
     */
    public function __construct()
    {
    }

    /**
     * Destructor of Object Class, which simply serves as a marker for child
     * classes.
     *
     * @access public
     */
    public function __destruct()
    {
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
    public function equals(Objective $object)
    {
        return ($this == $object);
    }

    /**
     * {@inheritdoc}
     */
    public function getClassName()
    {
        return new String(get_class($this));
    }

    /**
     * The hashCode method, returns the hash code for the very Object.
     *
     * @access public
     *
     * @return float
     */
    public function hashCode()
    {
        return (float) hexdec(spl_object_hash($this));
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
}
