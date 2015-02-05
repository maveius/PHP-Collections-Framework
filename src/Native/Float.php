<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * The Float Class, extending from the abstract Number class.
 *
 * This class serves as a wrapper class for primitive data type float.
 *
 * It is a final class, no child class shall derive from Float.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Float extends Number
{
    /**
     * Base constant, stores the base used for exponent.
     */
    const Base = 10;

    /**
     * MinCoeff constant, specifies the coefficient for minimum exponent.
     */
    const MinCoeff = 1.4;

    /**
     * MaxCoeff constant, specifies the coefficient for maximum exponent.
     */
    const MaxCoeff = 3.4;

    /**
     * MinExp constant, defines the minimum allowable exponent.
     */
    const MinExp = -45;

    /**
     * MaxExp constant, defines the maximum allowable exponent.
     */
    const MaxExp = 38;

    /**
     * The getExp method, gets the exponent of this number.
     *
     * @access private
     *
     * @param int|float $value
     *
     * @return Int
     */
    private function getExp($value)
    {
        return (int) log10(abs($value));
    }

    /**
     * The getMax method, gets the maximum allowable number in Float class.
     *
     * @access private
     *
     * @return Float
     */
    private function getMax()
    {
        return (self::MaxCoeff * pow(self::Base, self::MaxExp));
    }

    /**
     * The getMin method, gets the minimum allowable number in Float class.
     *
     * @access private
     *
     * @return Float
     */
    private function getMin()
    {
        return (-1 * self::MaxCoeff * pow(self::Base, self::MaxExp));
    }

    /**
     * The toByte method, converts value and returns a Byte Object.
     *
     * @access public
     *
     * @return Byte
     *
     * @throws ClassCastException
     */
    public function toByte()
    {
        if ($this->intValue($this->getValue()) < Byte::MinValue or $this->intValue($this->getValue()) > Byte::MaxValue) {
            throw new ClassCastException("Cannot convert to Byte type");
        }

        return new Byte($this->getValue());
    }

    /**
     * The toShort method, converts value and returns a Short Object.
     *
     * @access public
     *
     * @return Short
     *
     * @throws ClassCastException
     */
    public function toShort()
    {
        if ($this->intValue($this->getValue()) < Short::MinValue or $this->intValue($this->getValue()) > Short::MaxValue) {
            throw new ClassCastException("Cannot convert to Short type");
        }

        return new Short($this->getValue());
    }

    /**
     * The toInteger method, converts value and returns an Integer Object.
     *
     * @access public
     *
     * @return Integer
     *
     * @throws ClassCastException
     */
    public function toInteger()
    {
        if ($this->intValue($this->getValue()) < Integer::MinValue or $this->intValue($this->getValue()) > Integer::MaxValue) {
            throw new ClassCastException("Cannot convert to Integer type");
        }

        return new Integer($this->getValue());
    }

    /**
     * The toLong method, converts value and returns a Long Object.
     *
     * @access public
     *
     * @return Long
     *
     * @throws ClassCastException
     */
    public function toLong()
    {
        if ($this->intValue($this->getValue()) < Long::MinValue or $this->intValue($this->getValue()) > Long::MaxValue) {
            throw new ClassCastException("Cannot convert to Long type");
        }

        return new Long($this->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (!is_float($value)) {
            $value = (float) $value;
        }

        if ($value > $this->getMax()) {
            throw new InvalidArgumentException("Supplied value cannot be greater than 3.4*10e+38 for Float type");
        } elseif ($value < $this->getMin()) {
            throw new InvalidArgumentException("Supplied value cannot be smaller than -3.4*10e+38 for Float type");
        } elseif ($this->getExp($value) < self::MinExp) {
            throw new InvalidArgumentException("Supplied value with exponent cannot be less than 1.4*10e-45 for Float type");
        }

        return $value;
    }
}
