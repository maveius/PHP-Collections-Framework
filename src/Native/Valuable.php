<?php

namespace Mysidia\Resource\Native;

/**
 * Returns the primitive value of an object.
 *
 * @category  Resource
 * @package   Collection
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Valuable
{
    /**
     * Returns the primitive value of an object.
     *
     * @access public
     *
     * @return mixed
     */
    public function getValue();
}
