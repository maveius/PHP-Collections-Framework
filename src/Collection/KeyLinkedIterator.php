<?php

namespace Mysidia\Resource\Collection;

/**
 * The KeyLinkedIterator Class, extending from the abstract LinkedHashMapIterator Class.
 * It defines a standard key iterator for LinkedHashMap, subclasses of LinkedHashMap may have own implementations.
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */

class KeyLinkedIterator extends LinkedHashMapIterator{
		
	/**
     * The next method, returns the next key in iteration.
     * @access public
     * @return Objective
     */		
	public function next(){
	    return $this->nextEntry()->getKey();	
	}
	
	/**
     * The nextValue method, returns the next value in iteration.
     * @access public
     * @return Objective
     */		
	public function nextValue(){
	    return $this->nextEntry()->getValue();	
	}		
}
?>
