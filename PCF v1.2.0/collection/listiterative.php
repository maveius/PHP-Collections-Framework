<?php

namespace Resource\Collection;
use Resource\Native\Objective;

/**
 * The ListIterative Interface, extending from the Iterative interface.
 * It defines a standard interface for list iterators, it can traverse forward or backward.
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */

interface ListIterative extends Iterative{

 	/**
     * The add method, append an object to the end of the iterator.
     * @param Objective  $object 
     * @access public
     * @return Boolean
     */	
	public function add(Objective $object);

 	/**
     * The hasPrevious method, checks if the list iterator has objects before its current index.
     * @access public
     * @return Boolean
     */		
	public function hasPrevious();
	
 	/**
     * The nextIndex method, return the next index on the list iterator.
     * @access public
     * @return Int
     */			
	public function nextIndex();
	
 	/**
     * The nextIndex method, acquires the previous object on the list iterator.
     * @access public
     * @return Objective
     */			
	public function previous();
	
 	/**
     * The previousIndex method, return the previous index on the list iterator.
     * @access public
     * @return Int
     */			
	public function previousIndex();
	
	/**
     * The set method, updates the object at the current index.
     * @param Objective  $object 
     * @access public
     * @return Void
     */		
	 public function set(Objective $object);
	
}
    
?>