<?php

namespace Mysidia\Resource;

use Mysidia\Resource\Native\String as StringObject;

/**
 * Returns string or string object representation of an object
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

    /**
     * Returns String object representation of an object
     *
     * @return StringObject
     */
    public function toString();

    /**
     * Returns String object representation of an object
     *
     * @return StringObject
     */
    public function string();

    /**
     * Returns String object representation of an object
     *
     * @return StringObject
     */
    public function getClassName();

    /**
     * Returns String object representation of an object
     *
     * @return StringObject
     */
    public function className();
}
