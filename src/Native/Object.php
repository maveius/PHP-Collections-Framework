<?php

namespace Mysidia\Resource\Native;

/**
 * The Abstract Object Class, root of all Mysidia library files.
 * Contrary to Java's Object root class, this one is abstract.
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
     * Constructor of Object Class, which simply serves as a marker for child classes.
     *
     * @access public
     */
    public function __construct()
    {
    }

    /**
     * Destructor of Object Class, which simply serves as a marker for child classes.
     *
     * @access public
     */
    public function __destruct()
    {
    }

    /**
     * Magic method __clone() for Object Class, returns a copy of Object with additional operations.
     *
     * @access public
     *
     * @return Object
     */
    public function __clone()
    {
        return unserialize(serialize($this));
    }

    /**
     * The equals method, checks whether target object is equivalent to this one.
     *
     * @access public
     *
     * @param Objective $object
     *
     * @return Boolean
     */
    public function equals(Objective $object)
    {
        return ($this == $object);
    }

    /**
     * The getClassName method, returns class name of an instance.
     *
     * The return value may differ depending on child classes.
     *
     * @access public
     *
     * @return String
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
     * The serialize method, serializes an object into string format.
     *
     * A serialized string can be stored in Constants, Database and Sessions.
     *
     * @access public
     *
     * @return String
     */
    public function serialize()
    {
        return serialize($this);
    }

    /**
     * The unserialize method, decode a string to its object representation.
     *
     * This method can be used to retrieve object info from Constants, Database and Sessions.
     *
     * @access public
     *
     * @param String $string
     *
     * @return String
     */
    public function unserialize($string)
    {
        return unserialize($string);
    }

    /**
     * Magic method __toString() for Object class, returns object information.
     *
     * @access public
     *
     * @return String
     */
    public function __toString()
    {
        return get_class($this);
    }
}
