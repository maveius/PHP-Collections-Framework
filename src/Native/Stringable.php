<?php

namespace Mysidia\Resource\Native;

/**
 * Stringable defines methods for converting objects to strings and String
 * objects.
 *
 * @category  Resource
 * @package   Native
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Stringable
{
    /**
     * Returns string representation of an object.
     *
     * @access public
     *
     * @return string
     */
    public function __toString();

    /**
     * Returns String object representation of an object.
     *
     * @access public
     *
     * @return String
     */
    public function toString();

    /**
     * Alias for toString
     *
     * @access public
     *
     * @return String
     */
    public function getClassName();
}
