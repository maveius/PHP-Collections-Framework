<?php

namespace Mysidia\Resource\Native;

use Exception;
use Mysidia\Resource\Utility\Comparable;

/**
 * The Char Class, extending from the root Object class.
 * This class serves as a wrapper class for primitive data type char.
 * It is a final class, no child class shall derive from Char.
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 *
 */
final class Char extends Object implements Comparable
{
    /**
     * Size constant, specifies the size a byte value occupies.
     */
    const Size = 8;

    /**
     * MinValue constant, a byte cannot contain number less than -128.
     */
    const MinValue = '\u0000';

    /**
     * MaxValue constant, a byte cannot contain number greater than 127.
     */
    const MaxValue = '\uFFFF';

    /**
     * Constructor of Char Class, initializes the Char wrapper class.
     * If supplied argument is a string or an integer with more than one digit, it will generate error message.
     *
     * @param Char $char
     *
     * @access public
     * @return Void
     */
    public function __construct($char)
    {
        $this->verify($char);
        $this->value = $char;
    }

    /**
     * The verify method, validates the supplied argument to see if a Char Object can be instantiated.
     *
     * @param Char $char
     *
     * @access public
     * @return Boolean
     */
    public function verify($char)
    {
        if (strlen(string($char)) > 1) {
            throw new Exception('Cannot supply a character with longer than length 1.');
        }

        return true;
    }

    /**
     * The compareTo method, compares this Char value to another.
     *
     * @param Char $char
     *
     * @access public
     * @return Int
     */
    public function compareTo(Comparable $target)
    {
        return ($this->equals($target)) ? 0 : ($this->value - $target->getValue());
    }

    /**
     * Magic method to_String() for Char class, casts char value into string.
     * @access public
     * @return String
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
