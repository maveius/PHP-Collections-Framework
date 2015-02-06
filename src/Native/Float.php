<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * A float type wrapper
 *
 * @author Ordland
 */
final class Float extends Number
{
    /**
     * Base used for exponent
     */
    const Base = 10;

    /**
     * Coefficient for minimum exponent
     */
    const MinCoeff = 1.4;

    /**
     * Coefficient for maximum exponent
     */
    const MaxCoeff = 3.4;

    /**
     * Minimum allowable exponent
     */
    const MinExp = -45;

    /**
     * Maximum allowable exponent
     */
    const MaxExp = 38;

    /**
     * Returns the exponent of this number
     *
     * @param int|float $value
     *
     * @return int
     */
    private function getExp($value)
    {
        return (int) log10(abs($value));
    }

    /**
     * Returns the maximum allowable number in Float class
     *
     * @return float
     */
    private function getMax()
    {
        return (float) self::MaxCoeff * pow(self::Base, self::MaxExp);
    }

    /**
     * Returns the minimum allowable number in Float class
     *
     * @return float
     */
    private function getMin()
    {
        return (float) -1 * self::MaxCoeff * pow(self::Base, self::MaxExp);
    }

    /**
     * Converts value and returns a Byte object
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
     * Converts value and returns a Short object
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
     * Converts value and returns an Integer object
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
     * Converts value and returns a Long object
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
