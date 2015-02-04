<?php

namespace Mysidia\Resource\Native;

/**
 * Returns a deep copy of an object.
 *
 * @category  Resource
 * @package   Collection
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Cloneable
{
    /**
     * Returns a deep copy of an object.
     *
     * @access public
     *
     * @return $this
     */
    public function __clone();
}
