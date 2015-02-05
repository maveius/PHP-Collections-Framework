<?php

namespace Mysidia\Resource;

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
     * @param Valuable $object
     *
     * @return int
     */
    public function compareTo(Valuable $object);

    /**
     * The equals method, checks whether target object is equivalent to this
     * one.
     *
     * @access public
     *
     * @param mixed $object
     *
     * @return bool
     */
    public function equals($object);
}
