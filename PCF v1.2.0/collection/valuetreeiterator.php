<?php

namespace Resource\Collection;
use Resource\Native\Objective;

/**
 * The ValueTreeIterator Class, extending from the abstract TreeMapIterator Class.
 * It defines a standard value iterator for TreeMap, which will come in handy.
 * This is a final class, and thus no child class shall inherit from it. 
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 * @final
 *
 */

final class ValueTreeIterator extends TreeMapIterator{
		
	/**
     * The next method, returns the next value in iteration.
     * @access public
     * @return Objective
     */		
	public function next(){
	    return $this->nextEntry()->getValue();	
	}
	
	/**
     * The nextKey method, returns the next key in iteration.
     * @access public
     * @return Objective
     */		
	public function nextKey(){
	    return $this->nextEntry()->getKey();	
	}	
}
?>