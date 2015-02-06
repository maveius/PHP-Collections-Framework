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
     * @return String
     */
    public function binaryString()
    {
        return new String(decbin($this->getValue()));
    }

    /**
     * Converts numeric values to hex String
     *
     * @return String
     */
    public function hexString()
    {
        return new String(dechex($this->getValue()));
    }

    /**
     * Converts numeric values to octal String
     *
     * @return String
     */
    public function octalString()
    {
        return new String(decoct($this->getValue()));
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
        if ($this->getValue() < Byte::MinValue or $this->getValue() > Byte::MaxValue) {
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
        if ($this->getValue() < Short::MinValue or $this->getValue() > Short::MaxValue) {
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
        if ($this->getValue() < Integer::MinValue or $this->getValue() > Integer::MaxValue) {
            throw new ClassCastException("Cannot convert to Integer type");
        }

        return new Integer($this->getValue());
    }
}
