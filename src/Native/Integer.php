<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * An integer type wrapper
 *
 * @author Ordland
 */
final class Integer extends Number
{
    /**
     * An integer cannot contain number less than -2147483648
     */
    const MinValue = -2147483648;

    /**
     * An integer cannot contain number greater than 2147483647
     */
    const MaxValue = 2147483647;

    /**
     * Converts numeric values to a binary String
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
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (!is_int($value)) {
            $value = (int) $value;
        }

        if ($value > self::MaxValue) {
            throw new InvalidArgumentException("Supplied value cannot be greater than 2147483647 for Int type");
        } elseif ($value < self::MinValue) {
            throw new InvalidArgumentException("Supplied value cannot be smaller than -2147483648 for Int type");
        }

        return $value;
    }
}
