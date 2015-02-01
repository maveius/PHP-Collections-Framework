<?php

namespace Resource\Native;
use SplFixedArray, ArrayIterator, Exception;

/**
 * The Arrays Class, extending from SplFixedArray class
 * It defines how fixed sized numeric arrays are used in Mysidia Adoptables.
 * @category Resource
 * @package Native
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 * @final
 *
 */

final class Arrays extends SplFixedArray implements Objective{

    /**
     * The equals method, checks whether target array is equivalent to this one.
     * @param Arrays  $array 
     * @access public
     * @return Boolean
     */
    public function equals(Objective $array){
	    if(!($array instanceof Arrays)) throw new Exception("Argument array must be an instance of Arrays.");
        return ($this == $array);
    } 
	
    /**
     * Magic method __clone() for Arrays Class, returns a copy of the array.
     * @access public
     * @return Arrays
     */	
    public function __clone(){
	    return clone $this;
	}	

	/**
     * The serialize method, serializes an array into string format.
     * @access public
     * @return String
     */
    public function serialize(){
        return serialize($this);
    }
   
    /**
     * The unserialize method, decode a string to its object representation.
	 * This method can be used to retrieve object info from Constants, Database and Sessions.
	 * @param String  $string
     * @access public
     * @return Arrays
     */
    public function unserialize($string){
        return unserialize($string);
    }
	
	/**
     * The length method, returns the size of the array in java way.
     * @access public
     * @return Int
     */	
    public function length(){
        return $this->count();
    }
	
	/**
     * The iterator method, retrieves an ArrayIterator for this Array.
     * @access public
     * @return ArrayIterator
     */	
    public function iterator(){
        return new ArrayIterator($this->toArray());
    }
	
	/**
     * The getClassName method, acquires the class name as Array.
     * @access public
     * @return String
     */		
    public function getClassName(){
	    return "Array";
	}
	
    /**
     * Magic method to_String() for Arrays class, returns basic array information.
     * @access public
     * @return String
     */	
	public function __toString(){
	    return "Array({$this->length()})";
	}
}
?>