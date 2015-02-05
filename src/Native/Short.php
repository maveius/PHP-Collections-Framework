<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * The Short Class, extending from the abstract Number class.
 *
 * This class serves as a wrapper class for primitive data type short.
 *
 * It is a final class, no child class shall derive from Short.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Short extends Number
{
    /**
     * MinValue constant, a Short cannot contain number less than -32768.
     */
    const MinValue = -32768;

    /**
     * MaxValue constant, a Short cannot contain number greater than 32767.
     */
    const MaxValue = 32767;

    /**
     * The binaryString method, converts numeric values to binary strings.
     *
     * @access public
     *
     * @return String
     */
    public function binaryString()
    {
        return new String(decbin($this->getValue()));
    }

    /**
     * The octalString method, converts numeric values to octal strings.
     *
     * @access public
     *
     * @return String
     */
    public function octalString()
    {
        return new String(decoct($this->getValue()));
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
        if ($this->getValue() < Byte::MinValue or $this->getValue() > Byte::MaxValue) {
            throw new ClassCastException("Cannot convert to Byte type");
        }

        return new Byte($this->getValue());
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
