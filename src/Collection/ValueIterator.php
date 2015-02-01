<?php

namespace Mysidia\Resource\Collection;

/**
 * The ValueIterator Class, extending from the abstract HashMapIterator Class.
 * It defines a standard value iterator for HashMap, subclasses of HashMap may have own implementations.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class ValueIterator extends HashMapIterator
{
    /**
     * The next method, returns the next value in iteration.
     * @access public
     * @return Objective
     */
    public function next()
    {
        return $this->nextEntry()->getValue();
    }

    /**
     * The nextKey method, returns the next key in iteration.
     * @access public
     * @return Objective
     */
    public function nextKey()
    {
        return $this->nextEntry()->getKey();
    }
}
