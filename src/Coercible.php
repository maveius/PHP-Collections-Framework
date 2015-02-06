<?php

namespace Mysidia\Resource;

use InvalidArgumentException;

/**
 * Coerces a value from any type to another
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
interface Coercible
{
    /**
     * Coerces a value from any type to another
     *
     * @param mixed $value
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function coerce($value);
}
