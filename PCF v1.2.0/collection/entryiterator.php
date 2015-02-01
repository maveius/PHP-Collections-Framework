<?php

namespace Mysidia\Resource\Collection;

/**
 * The EntryIterator Class, extending from the abstract HashMapIterator Class.
 * It defines a standard entry iterator for HashMap, subclasses of HashMap may have own implementations.
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */
 
class EntryIterator extends HashMapIterator{
		
	/**
     * The next method, returns the next entry in iteration.
     * @access public
     * @return Entry
     */		
	public function next(){
	    return $this->nextEntry();	
	}
	
	/**
     * The nextKey method, returns the next key in iteration.
     * @access public
     * @return Objective
     */		
	public function nextKey(){
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
