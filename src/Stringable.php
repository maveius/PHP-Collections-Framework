<?php

namespace Mysidia\Resource;

/**
 * Returns string representation of an object
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
interface Stringable
{
    /**
     * Returns string representation of an object
     *
     * @return string
     */
    public function __toString();
}
