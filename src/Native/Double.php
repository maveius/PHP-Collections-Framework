<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * A double type wrapper
 *
 * @author Ordland
 */
final class Double extends Number
{
    /**
     * Base constant for exponent
     */
    const Base = 10;

    /**
     * Coefficient for minimum exponent
     */
    const MinCoeff = 1.8;

    /**
     * Coefficient for maximum exponent
     */
    const MaxCoeff = 4.9;

    /**
     * Minimum allowable exponent
     */
    const MinExp = -324;

    /**
     * Maximum allowable exponent
     */
    const MaxExp = 308;

    /**
     * Returns the exponent of this number
     *
     * @param int|float $value
     *
     * @return int
     */
    private function exp($value)
    {
        return (int) log10(abs($value));
    }

    /**
     * Returns the maximum allowable number in Double class
     *
     * @return float
     */
    private function max()
    {
        return (float) self::MaxCoeff * pow(self::Base, self::MaxExp);
    }

    /**
     * Returns the minimum allowable number in Double class
     *
     * @return float
     */
    private function min()
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
    public function byteObject()
    {
        if ($this->integerValue() < Byte::MinValue or $this->integerValue() > Byte::MaxValue) {
            throw new ClassCastException("Cannot convert to Byte type");
        }

        return new Byte($this->integerValue());
    }

    /**
     * Converts value and returns a Short object
     *
     * @return Short
     *
     * @throws ClassCastException
     */
    public function shortObject()
    {
        if ($this->integerValue() < Short::MinValue or $this->integerValue() > Short::MaxValue) {
            throw new ClassCastException("Cannot convert to Short type");
        }

        return new Short($this->integerValue());
    }

    /**
     * Converts value and returns an Integer object
     *
     * @return Integer
     *
     * @throws ClassCastException
     */
    public function integerObject()
    {
        if ($this->integerValue() < Integer::MinValue or $this->integerValue() > Integer::MaxValue) {
            throw new ClassCastException("Cannot convert to Integer type");
        }

        return new Integer($this->integerValue());
    }

    /**
     * Converts value and returns a Long object
     *
     * @return Long
     *
     * @throws ClassCastException
     */
    public function longObject()
    {
        if ($this->integerValue() < Long::MinValue or $this->integerValue() > Long::MaxValue) {
            throw new ClassCastException("Cannot convert to Long type");
        }

        return new Long($this->integerValue());
    }

    /**
     * Converts value and returns a Float object
     *
     * Converting from double to float type is disabled
     *
     * @throws ClassCastException
     */
    public function floatObject()
    {
        throw new ClassCastException("Casting from Double to Float is not allowed");
    }

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (!is_double($value)) {
            $value = (double) $value;
        }

        if ($value > $this->max()) {
            throw new InvalidArgumentException("Supplied value cannot be greater than 4.9*10e+308 for Double type");
        } elseif ($value < $this->min()) {
            throw new InvalidArgumentException("Supplied value cannot be smaller than -4.9*10e+308 for Double type");
        } elseif ($this->exp($value) < self::MinExp) {
            throw new InvalidArgumentException("Supplied value with exponent cannot be less than 1.8*10e-324 for Double type");
        }

        return $value;
    }
}
