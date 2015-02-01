<?php

namespace Resource\Collection; 

/**
 * The DescendingSubSet Class, extending from the abstract EntrySubSet Class.
 * It defines a standard descending subset to hold entries in a SubMap, which will come in handy.
 * This is a final class, and thus no child class shall inherit from it.   
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 * @final
 *
 */
 
final class DescendingSubSet extends EntrySubSet{

	/**
     * The iterator method, acquires an instance of the entry iterator object of the DescendingEntrySet.
     * @access public
     * @return DescendingSubEntryIterator
     */			
    public function iterator(){
	    return new DescendingSubEntryIterator($this->map, $this->map->absHighest(), $this->map->absLow());
	}
}
?>