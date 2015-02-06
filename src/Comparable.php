<?php

namespace Mysidia\Resource;

/**
 * Compares and equates objects with one another
 *
 * @author Ordland
 */
interface Comparable
{
    /**
     * Compares this object with another
     *
     * @param Valuable $object
     *
     * @return int
     */
    public function compareTo(Valuable $object);

    /**
     * Checks whether another object is equivalent to this object
     *
     * @param mixed $object
     *
     * @return bool
     */
    public function equals($object);
}
