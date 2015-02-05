<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;

/**
 * The Char Class, extending from the root Object class.
 *
 * This class serves as a wrapper class for primitive data type char.
 *
 * It is a final class, no child class shall derive from Char.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Char extends Object
{
    /**
     * MinValue constant, a byte cannot contain number less than -128.
     */
    const MinValue = "\\u0000";

    /**
     * MaxValue constant, a byte cannot contain number greater than 127.
     */
    const MaxValue = "\\uFFFF";

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (strlen((string) $value) > 1) {
            throw new InvalidArgumentException("Cannot supply a character with longer than length 1");
        }

        return $value;
    }
}
