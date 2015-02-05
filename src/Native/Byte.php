<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;

/**
 * The Byte Class, extending from the abstract Number class.
 *
 * This class serves as a wrapper class for primitive data type byte.
 *
 * It is a final class, no child class shall derive from Byte.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Byte extends Number
{
    /**
     * MinValue constant, a byte cannot contain number less than -128.
     */
    const MinValue = -128;

    /**
     * MaxValue constant, a byte cannot contain number greater than 127.
     */
    const MaxValue = 127;

    /**
     * The binaryString method, converts numeric values to binary strings.
     * @access public
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
