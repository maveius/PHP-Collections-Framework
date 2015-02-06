<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;

/**
 * A char type wrapper
 *
 * @author Ordland
 */
final class Char extends Object
{
    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (!is_string($value)) {
            $value = (string) $value;
        }

        if (strlen($value) > 1) {
            throw new InvalidArgumentException("Char must be 1 character");
        }

        return $value;
    }
}
