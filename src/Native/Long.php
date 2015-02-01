<?php

namespace Mysidia\Resource\Native;
use Exception;
use Mysidia\Resource\Utility\Comparable;
use Mysidia\Resource\Exception\ClassCastException;

/**
 * The Long Class, extending from the abstract Number class.
 * This class serves as a wrapper class for primitive data type long.
 * It is a final class, no child class shall derive from Long.
 * @category Resource
 * @package Native
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 * @final
 *
 */
 
final class Long extends Number implements Comparable{
    
    /**
	 * Size constant, specifies the size a long value occupies.
    */	  
    const Size = 64;
	
	/**
	 * MinValue constant, a Long cannot contain number less than -9223372036854775808.
    */
    const MinValue = -9223372036854775808;
	
	/**
	 * MaxValue constant, a Long cannot contain number greater than 9223372036854775807.
    */
    const MaxValue = 9223372036854775807;
   
    
	/**
     * Constructor of Long Class, initializes the Long wrapper class.
	 * If supplied argument is not an integer, it will be converted to int primitive type.
	 * @param Number  $num
     * @access public
     * @return Void
     */
    public function __construct($num){
	    if(!is_int($num)) $num = (int)$num;
	    parent::__construct($num);		
        $this->value = $num;
    }
	
	/**
     * The verify method, validates the supplied argument to see if a Long object can be instantiated.
	 * @param Number  $num
     * @access public
     * @return Boolean
     */
	public function verify($num){
	    if($num > self::MaxValue) throw new Exception('Supplied value cannot be greater than -9223372036854775808 for Long type.');
 		elseif($num < self::MinValue) throw new Exception('Supplied value cannot be smaller than -9223372036854775808 for Long type.');
		else return TRUE;
	}
	
	/**
     * The compareTo method, compares this Long value to another number.
	 * @param Number  $target
     * @access public
     * @return Int
     */
    public function compareTo(Number $target){
        return ($this->equals($target))?0:($this->value - $target->getValue());
    }
	
 	/**
     * The binaryString method, converts numeric values to binary strings.
     * @access public
     * @return String
     */
	public function binaryString(){
        return new String(decbin($this->value));	
	}

	/**
     * The hexString method, converts numeric values to hex strings.
     * @access public
     * @return String
     */
	public function hexString(){
	    return new String(dechex($this->value));
	}
	
	/**
     * The octalString method, converts numeric values to octal strings.
     * @access public
     * @return String
     */
	public function octalString(){
        return new String(decoct($this->value));	
	}
	
	/**
     * The toByte method, converts value and returns a Byte Object.
     * @access public
     * @return Byte
     */
    public function toByte(){
	    if($this->value < Byte::MinValue or $this->value > Byte::MaxValue){
	        throw new ClassCastException('Cannot convert to Byte type.');  
	    }
	    return new Byte($this->value);
	}
 
    /**
     * The toShort method, converts value and returns a Short Object.
     * @access public
     * @return Short
     */
	public function toShort(){
	    if($this->value < Short::MinValue or $this->value > Short::MaxValue){
	        throw new ClassCastException('Cannot convert to Short type.');  
	    }
	    return new Short($this->value);
	}
	
	/**
     * The toInteger method, converts value and returns an Integer Object.
     * @access public
     * @return Integer
     */
	public function toInteger(){
	    if($this->value < Integer::MinValue or $this->value > Integer::MaxValue){
	        throw new ClassCastException('Cannot convert to Integer type.');  
	    }
	    return new Integer($this->value);
	}	
}
?>
