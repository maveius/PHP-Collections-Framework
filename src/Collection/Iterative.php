<?php

namespace Mysidia\Resource\Collection;
use Iterator;

/**
 * The Iterative Interface, extending from the Iterator interface.
 * It defines a standard interface for iterators used in Collection Framework.
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */

interface Iterative extends Iterator{

 	/**
     * The hasNext method, checks if the iterator has not reached the end of its iteration yet.
     * @access public
     * @return Boolean
     */	
    public function hasNext();
	
 	/**
     * The next method, returns the next object in the iteration.
     * @access public
     * @return Objective
     */		
	public function next();
	
 	/**
     * The remove method, removes from the underlying collection the last element returned by the iterator.
     * @access public
     * @return Void
     */			
	public function remove();
}
    
?>
