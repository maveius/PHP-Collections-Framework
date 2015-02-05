<?php

namespace Mysidia\Resource\Native;

/**
 * The Abstract Number Class, extends parent Object root class.
 *
 * Similar to Java's number class, it's parent to all numeric type wrapper
 * classes. A number cannot be instantiated using new keyword, since it's
 * abstract.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @abstract
 *
 */
abstract class Number extends Object
{
    /**
     * The intValue method, casts and fetches int primitive value.
     *
     * @access public
     *
     * @return Int
     */
    public function intValue()
    {
        return (int) $this->value;
    }

    /**
     * The floatValue method, casts and fetches float primitive value.
     *
     * @access public
     *
     * @return Float
     */
    public function floatValue()
    {
        return (float) $this->value;
    }

    /**
     * The doubleValue method, casts and fetches double primitive value.
     *
     * @
     * access public
     * @return Double
     */
    public function doubleValue()
    {
        return (double) $this->value;
    }

    /**
     * The isPositive method, checks if the number is positive or not.
     *
     * @access public
     *
     * @return Boolean
     */
    public function isPositive()
    {
        return ($this->getValue() > 0) ? true : false;
    }

    /**
     * The isNegative method, checks if the number is negative or not.
     *
     * @access public
     *
     * @return Boolean
     */
    public function isNegative()
    {
        return ($this->getValue() < 0) ? true : false;
    }

    /**
     * The toByte method, converts value and returns a Byte Object.
     *
     * @access public
     *
     * @return Byte
     */
    public function toByte()
    {
        return new Byte($this->getValue());
    }

    /**
     * The toShort method, converts value and returns a Short Object.
     *
     * @access public
     *
     * @return Short
     */
    public function toShort()
    {
        return new Short($this->getValue());
    }

    /**
     * The toInteger method, converts value and returns an Integer Object.
     *
     * @access public
     *
     * @return Integer
     */
    public function toInteger()
    {
        return new Integer($this->getValue());
    }

    /**
     * The toLong method, converts value and returns a Long Object.
     *
     * @access public
     *
     * @return Long
     */
    public function toLong()
    {
        return new Long($this->getValue());
    }

    /**
     * The toFloat method, converts value and returns a Float Object.
     *
     * @access public
     *
     * @return Float
     */
    public function toFloat()
    {
        return new Float($this->getValue());
    }

    /**
     * The toFloat method, converts value and returns a Double Object.
     *
     * @access public
     *
     * @return Double
     */
    public function toDouble()
    {
        return new Double($this->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return parent::__toString()."(".$this->getValue().")";
    }

    /**
     * {@inheritdoc}
     */
    public function getClassName()
    {
        return parent::getClassName()."(".$this->getValue().")";
    }
}
