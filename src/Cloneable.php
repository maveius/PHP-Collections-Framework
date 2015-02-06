<?php

namespace Mysidia\Resource;

/**
 * Returns a deep copy of an object
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
interface Cloneable
{
    /**
     * Returns a deep copy of an object
     *
     * @return $this
     */
    public function __clone();
}
