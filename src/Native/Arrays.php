<?php

namespace Mysidia\Resource\Native;

use ArrayIterator;
use Exception;
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
 *
 */
final class Arrays extends SplFixedArray implements Objective
{
    /**
     * The equals method, checks whether target array is equivalent to this one.
     *
     * @access public
     *
     * @param Objective $array
     *
     * @return bool
     *
     * @throws Exception
     */
    public function equals(Objective $array)
    {
        if (!($array instanceof Arrays)) {
            throw new Exception("Argument array must be an instance of Arrays.");
        }

        return ($this == $array);
    }

    /**
     * Magic method __clone() for Arrays Class, returns a copy of the array.
     *
     * @access public
     *
     * @return Arrays
     */
    public function __clone()
    {
        return unserialize(serialize($this));
    }

    /**
     * The serialize method, serializes an array into string format.
     *
     * @access public
     *
     * @return string
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
     * @param string $string
     *
     * @return $this
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
     * The getClassName method, acquires the class name as Array.
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
     * Magic method to_String() for Arrays class, returns basic array information.
     *
     * @access public
     *
     * @return string
     */
    public function __toString()
    {
        return get_class($this)."(".$this->length().")";
    }
}
