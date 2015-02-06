<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * A long type wrapper
 *
 * @author Ordland
 */
final class Long extends Number
{
    /**
     * A long cannot contain number less than -9223372036854775808
     */
    const MinValue = -9223372036854775808;

    /**
     * A long cannot contain number greater than 9223372036854775807
     */
    const MaxValue = 9223372036854775807;

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (!is_int($value)) {
            $value = (int) $value;
        }

        if ($value > self::MaxValue) {
            throw new InvalidArgumentException("Supplied value cannot be greater than -9223372036854775808 for Long type");
        } elseif ($value < self::MinValue) {
            throw new InvalidArgumentException("Supplied value cannot be smaller than -9223372036854775808 for Long type");
        }

        return $value;
    }

    /**
     * Converts numeric values to binary String
     *
     * @return string
     */
    public function binaryValue()
    {
        return decbin($this->value());
    }

    /**
     * Converts numeric values to hex String
     *
     * @return string
     */
    public function hexValue()
    {
        return dechex($this->value());
    }

    /**
     * Converts numeric values to octal String
     *
     * @return string
     */
    public function octalValue()
    {
        return decoct($this->value());
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
        if ($this->value() < Byte::MinValue or $this->value() > Byte::MaxValue) {
            throw new ClassCastException("Cannot convert to Byte type");
        }

        return new Byte($this->value());
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
        if ($this->value() < Short::MinValue or $this->value() > Short::MaxValue) {
            throw new ClassCastException("Cannot convert to Short type");
        }

        return new Short($this->value());
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
        if ($this->value() < Integer::MinValue or $this->value() > Integer::MaxValue) {
            throw new ClassCastException("Cannot convert to Integer type");
        }

        return new Integer($this->value());
    }
}
