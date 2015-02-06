<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;

/**
 * A byte type wrapper
 *
 * @author Ordland
 */
final class Byte extends Number
{
    /**
     * A byte cannot contain number less than -128
     */
    const MinValue = -128;

    /**
     * A byte cannot contain number greater than 127
     */
    const MaxValue = 127;

    /**
     * Converts numeric values to binary strings
     *
     * @return String
     */
    public function binaryString()
    {
        return new String(decbin($this->value));
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
            throw new InvalidArgumentException("Supplied value cannot be greater than 127 for Byte type");
        } elseif ($value < self::MinValue) {
            throw new InvalidArgumentException("Supplied value cannot be smaller than -128 for Byte type");
        }

        return $value;
    }
}
