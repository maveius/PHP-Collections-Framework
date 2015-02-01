<?php

namespace Mysidia\Resource\Collection; 

/**
 * The AscendingSubSet Class, extending from the abstract EntrySubSet Class.
 * It defines a standard ascending subset to hold entries in a SubMap, which will come in handy.
 * This is a final class, and thus no child class shall inherit from it.   
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com
 *
 */  
 
final class AscendingSubSet extends EntrySubSet{

	/**
     * The iterator method, acquires an instance of the entry iterator object of the AscendingEntrySet.
     * @access public
     * @return EntrySubIterator
     */			
    public function iterator(){
	    return new EntrySubIterator($this->map, $this->map->absLowest(), $this->map->absHigh());
	}
}
?>
