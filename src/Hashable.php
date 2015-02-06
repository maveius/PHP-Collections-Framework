<?php

namespace Mysidia\Resource;

/**
 * Returns a deep copy of an object.
 *
 * @category  Resource
 * @package   Collection
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Hashable
{
    /**
     * Returns a unique object hash.
     *
     * @access public
     *
     * @return float
     */
    public function hashCode();
}
