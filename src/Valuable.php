<?php

namespace Mysidia\Resource;

/**
 * Returns the primitive value of an object
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
interface Valuable
{
    /**
     * Returns the primitive value of an object
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Returns the primitive value of an object
     *
     * @return mixed
     */
    public function value();
}
