<?php

namespace Mysidia\Resource\Utility;

use Mysidia\Resource\Native\Objective;

/**
 * The Comparable Interface, it defines objects that can be compared with
 * another.
 *
 * @category  Resource
 * @package   Utility
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Comparable
{
    /**
     * The compareTo method, compares this object with another.
     *
     * @access public
     *
     * @param Objective $object
     *
     * @return int
     */
    public function compareTo(Objective $object);
}
