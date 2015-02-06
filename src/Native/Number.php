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
    public function intValue()
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
        return ($this->getValue() > 0) ? true : false;
    }

    /**
     * Checks if the number is negative
     *
     * @return bool
     */
    public function isNegative()
    {
        return ($this->getValue() < 0) ? true : false;
    }

    /**
     * Converts value and returns a Byte object
     *
     * @return Byte
     */
    public function toByte()
    {
        return new Byte($this->getValue());
    }

    /**
     * Converts value and returns a Short object
     *
     * @return Short
     */
    public function toShort()
    {
        return new Short($this->getValue());
    }

    /**
     * Converts value and returns an Integer object
     *
     * @return Integer
     */
    public function toInteger()
    {
        return new Integer($this->getValue());
    }

    /**
     * Converts value and returns a Long object
     *
     * @return Long
     */
    public function toLong()
    {
        return new Long($this->getValue());
    }

    /**
     * Converts value and returns a Float object
     *
     * @return Float
     */
    public function toFloat()
    {
        return new Float($this->getValue());
    }

    /**
     * Converts value and returns a Double object
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
