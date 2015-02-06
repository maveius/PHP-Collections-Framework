<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * A short type wrapper
 *
 * @author Ordland
 */
final class Short extends Number
{
    /**
     * A short cannot contain number less than -32768
     */
    const MinValue = -32768;

    /**
     * A short cannot contain number greater than 32767
     */
    const MaxValue = 32767;

    /**
     * Converts numeric values to binary String
     *
     * @return String
     */
    public function binaryString()
    {
        return new String(decbin($this->value()));
    }

    /**
     * Converts numeric values to octal String
     *
     * @return String
     */
    public function octalString()
    {
        return new String(decoct($this->value()));
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
        if ($this->value() < Byte::MinValue or $this->value() > Byte::MaxValue) {
            throw new ClassCastException("Cannot convert to Byte type");
        }

        return new Byte($this->value());
    }

    /**
     * {@inheritdoc}
     */
    public function verify($value)
    {
        if (!is_int($value)) {
            $value = (int) $value;
        }

        if ($value > self::MaxValue) {
            throw new InvalidArgumentException("Supplied value cannot be greater than 32767 for Short type");
        } elseif ($value < self::MinValue) {
            throw new InvalidArgumentException("Supplied value cannot be smaller than -32768 for Short type");
        }

        return $value;
    }
}
