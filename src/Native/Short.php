<?php

namespace Mysidia\Resource\Native;

use Exception;
use Mysidia\Resource\Exception\ClassCastException;
use Mysidia\Resource\Utility\Comparable;

/**
 * The Short Class, extending from the abstract Number class.
 * This class serves as a wrapper class for primitive data type short.
 * It is a final class, no child class shall derive from Short.
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 *
 */
final class Short extends Number implements Comparable
{
    /**
     * Size constant, specifies the size a short value occupies.
     */
    const Size = 16;

    /**
     * MinValue constant, a Short cannot contain number less than -32768.
     */
    const MinValue = -32768;

    /**
     * MaxValue constant, a Short cannot contain number greater than 32767.
     */
    const MaxValue = 32767;

    /**
     * Constructor of Short Class, initializes the Short wrapper class.
     * If supplied argument is not an integer, it will be converted to int primitive type.
     *
     * @param Number $num
     *
     * @access public
     * @return Void
     */
    public function __construct($num)
    {
        if (!is_int($num)) {
            $num = (int) $num;
        }
        parent::__construct($num);
        $this->value = $num;
    }

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
     * The compareTo method, compares this Short value to another number.
     *
     * @param Number $target
     *
     * @access public
     * @return Int
     */
    public function compareTo(Number $target)
    {
        return ($this->equals($target)) ? 0 : ($this->value - $target->getValue());
    }

    /**
     * The octalString method, converts numeric values to octal strings.
     * @access public
     * @return String
     */
    public function octalString()
    {
        return new String(decoct($this->value));
    }

    /**
     * The toByte method, converts value and returns a Byte Object.
     * @access public
     * @return Byte
     */
    public function toByte()
    {
        if ($this->value < Byte::MinValue or $this->value > Byte::MaxValue) {
            throw new ClassCastException('Cannot convert to Byte type.');
        }

        return new Byte($this->value);
    }

    /**
     * The verify method, validates the supplied argument to see if a Short object can be instantiated.
     *
     * @param Number $num
     *
     * @access public
     * @return Boolean
     */
    public function verify($num)
    {
        if ($num > self::MaxValue) {
            throw new Exception('Supplied value cannot be greater than 32767 for Short type.');
        } elseif ($num < self::MinValue) {
            throw new Exception('Supplied value cannot be smaller than -32768 for Short type.');
        } else {
            return true;
        }
    }
}
