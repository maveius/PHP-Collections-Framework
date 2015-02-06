<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * The Integer Class, extending from the abstract Number class.
 *
 * This class serves as a wrapper class for primitive data type int.
 *
 * It is a final class, no child class shall derive from Integer.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Integer extends Number
{
    /**
     * MinValue constant, an integer cannot contain number less than
     * -2147483648.
     */
    const MinValue = -2147483648;

    /**
     * MaxValue constant, an integer cannot contain number greater than
     * 2147483647.
     */
    const MaxValue = 2147483647;

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
     * The hexString method, converts numeric values to hex strings.
     *
     * @access public
     *
     * @return String
     */
    public function hexString()
    {
        return new String(dechex($this->getValue()));
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
     * The toShort method, converts value and returns a Short Object.
     *
     * @access public
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
