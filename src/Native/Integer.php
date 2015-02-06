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
