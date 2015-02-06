<?php

namespace Mysidia\Resource\Native;

/**
 * A number type wrapper
 *
 * @author Ordland
 *
 */
abstract class Number extends Object
{
    /**
     * Returns integer value
     *
     * @return int
     */
    public function integerValue()
    {
        return (int) $this->value;
    }

    /**
     * Returns float value
     *
     * @return Float
     */
    public function floatValue()
    {
        return (float) $this->value;
    }

    /**
     * Returns double value
     *
     * @return double
     */
    public function doubleValue()
    {
        return (double) $this->value;
    }

    /**
     * Checks if the number is positive
     *
     * @return bool
     */
    public function isPositive()
    {
        return ($this->value() > 0) ? true : false;
    }

    /**
     * Checks if the number is negative
     *
     * @return bool
     */
    public function isNegative()
    {
        return ($this->value() < 0) ? true : false;
    }

    /**
     * Converts value and returns a Byte object
     *
     * @return Byte
     */
    public function byteObject()
    {
        return new Byte($this->value());
    }

    /**
     * Converts value and returns a Short object
     *
     * @return Short
     */
    public function shortObject()
    {
        return new Short($this->value());
    }

    /**
     * Converts value and returns an Integer object
     *
     * @return Integer
     */
    public function integerObject()
    {
        return new Integer($this->value());
    }

    /**
     * Converts value and returns a Long object
     *
     * @return Long
     */
    public function longObject()
    {
        return new Long($this->value());
    }

    /**
     * Converts value and returns a Float object
     *
     * @return Float
     */
    public function floatObject()
    {
        return new Float($this->value());
    }

    /**
     * Converts value and returns a Double object
     *
     * @return Double
     */
    public function doubleObject()
    {
        return new Double($this->value());
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return parent::__toString()."(".$this->value().")";
    }
}
