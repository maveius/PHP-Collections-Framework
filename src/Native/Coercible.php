<?php

namespace Mysidia\Resource\Native;

/**
 * Defines methods for coercing values from any type to an expected type.
 *
 * @category  Resource
 * @package   Collection
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Coercible
{
    /**
     * Coerces a value from any type to an expected type.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function coerce($value);
}
