<?php

namespace Mysidia\Resource\Native;
use Iterator, Serializable;
use Mysidia\Resource\Utility\Comparable;
use Mysidia\Resource\Exception\IllegalArgumentException;

/**
 * The String Class, extending from the root Object class.
 * This class serves as a wrapper class for primitive data type string.
 * In Mysidia, String can have subclasses depending on the extension used.
 * @category Resource
 * @package Native
 * @author Hall of Famer
 * @copyright Mysidia Adoptables Script
 * @link http://www.mysidiaadoptables.com
 * @since 1.4.0
 * @todo Not much at this moment.
 *
 */

class String extends Object implements Comparable, Iterator, Serializable{
    
    /**
	 * Alphabatic constant, wraps a string literal of available alphabetic chars.
     */
    const Alphabatic = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
	/**
	 * AlphaNumeric constant, specifies a collection of available alphanumeric chars.
     */
    const AlphaNumeric = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	
	/**
	 * LineBreak constant, defines the line break character.
     */
    const LineBreak = PHP_EOL;    
    
	/**
	 * Numeric constant, contains a list of available number chars.
     */
    const Numeric = '0123456789';
	
	/**
	 * Space constant, defines the space char.
     */
    const Space = ' ';
    
	/**
	 * The chars property, it stores the character array inside string object.
	 * @access protected
	 * @var Arrays
     */
    protected $chars;    
    
	/**
	 * The count property, it specifies the number of characters in this string.
	 * @access protected
	 * @var Int
     */
    protected $count;

	/**
	 * The hash property, it defines the hash code of this particular string.
	 * @access protected
	 * @var Int
     */
   protected $hash;
   
	/**
	 * The length property, its an integer object representation of property $count.
	 * @access protected
	 * @var Integer
     */
    protected $length;   
    
	/**
	 * The offset property, it specifies the first index of storage that is used.
	 * @access protected
	 * @var Int
     */
    protected $offset = 0;
    
	/**
	 * The spaces property, it stores an array of all white space characters.
	 * @access protected
	 * @var Strings
     */
    protected $spaces;     
    
	/**
	 * The value property, it stores the internal string literal.
	 * @access protected
	 * @var string
     */
    protected $value = ''; 
    
    
    /**
     * Constructs of String Class, it creates a string with given parameters.
     * @param mixed  $string 
     * @access public
     * @return Void
     */
    public function __construct($string = ''){
        if(is_scalar($string) or is_null($string)) $this->value = (string)$string;
        else $this->initialize($string);
    }
    
    /**
     * The getChars method, getter method for property $chars.
     * @access public
     * @return Chars
     */	
    public function getChars(){
        if(!$this->chars) $this->chars = $this->toCharArray();
	    return $this->chars;
	}    
    
    /**
     * The getValue method, getter method for property $length.
     * @access public
     * @return Integer
     */	
    public function getLength(){
	    if(!$this->length) $this->length = new Integer($this->count());
        return $this->length;
	}    
    
    /**
     * The getOffset method, getter method for property $offset.
     * @access public
     * @return int
     */	
    public function getOffset(){
	    return $this->offset;
	}       
    
    /**
     * The getSpaces method, getter method for property $spaces.
     * @access public
     * @return strings
     */	
    public function getSpaces(){
        if(!$this->spaces){
           $this->spaces = new Arrays/Strings(6);
           $this->spaces->initialize(new String(" "), new String("\r"), new String("\n"), 
                                     new String("\t"), new String("\0"), new String("\x0B"));           
        }
	    return $this->spaces;
	}     
    
    /**
     * The getValue method, getter method for property $value.
     * @access public
     * @return string
     */	
    public function getValue(){
	    return $this->value;
	}        
    
    
    /**
     * The callback method, carries out callback operation and returns the result.
     * @param mixed  $name 
     * @param array  $args 
     * @return mixed
     * @throws IllegalArgumentException
     */
    public function callback($name, array $args = array()){
        if (!is_callable($name)) throw new IllegalArgumentException('$name is not a valid callback.');
        array_unshift($args, $this->value);
        $result = call_user_func_array($name, $args);
        if(!is_string($result)) return $result;
        return new static($result);
    }
    
    /**
     * The capitalize method, capitalizes this given string.
     * @access public
     * @return String
     */
    public function capitalize(){
        return new static(ucfirst($this->value));
    }
    
    /**
     * The charAt method, finds the character at a specified index. 
     * @param Int  $index
     * @access public
     * @return Char
     */
    public function charAt(Int $index){
        return $this->substring($index, 1);
    } 
    
    /**
     * The compareTo method, compares this string to another supplied string.
     * @param Objective  $string
     * @access public
     * @return int
     */    
    public function compareTo(Objective $string){
        return strcmp($this->value, (string)$string);        
    }
    
    /**
     * The compareToIgnoreCase method, carries out case-insensitive comparison for strings.
     * @param String  $string
     * @access public
     * @return int
     */
    public function compareToIgnoreCase(String $string){
        return strncasecmp($this->value, (string)$string);
    }
    
    /**
     * The concat method, concatenates this string by another and returns the combined string.
     * @param string  $string
     * @access public
     * @return String
     */
    public function concat(String $string){
        return new static($this->value.(string)$string);
    }
    
    /**
     * The contains method, checks if the string contains a substring.
     * @param String  $substr
     * @access public
     * @return Boolean
     */
    public function contains(String $substr){
        return ($this->indexOf($substr) !== FALSE);
    }    
    
    /**
     * The count method, getter method for property $count.
     * @access public
     * @return int
     */	
    public function count(){
        if(!$this->count) $this->count = (int)strlen($this->value);
	    return $this->count;
	}
    
    /**
     * The current method, it simply returns the character at current offset.
     * @access public
     * @return Char
     */
    public function current(){
        return $this->charAt($this->offset);
    }
    
    /**
     * The endsWith method, checks if the string ends with a substring.
     * @param string  $substr 
     * @access public
     * @return Boolean
     */
    public function endsWith($substr){
        $substr = new static($substr);
        return ($this->lastIndexOf($substr)->getValue() == $this->count() - $substr->count());
    }
    
    /**
     * The equals method, evaluates if the two strings are equal.
     * This method is case sensitive, use equalsIgnoreCase() otherwise.
     * @param String $string
     * @access public
     * @return Boolean
     */
    public function equals(Objective $string){
        return ($this->compareTo($string) === 0);
    }
    
    /**
     * The equalsIgnoreCase method, checks string equality with case-insensitive.
     * @param String  $string
     * @access public
     * @return Boolean
     */
    public function equalsIgnoreCase(String $string){
        return ($this->compareToIgnoreCase($string) === 0);
    }
    
    /**
     * The explode method, convert a string to an array based on the delimiter provided.
     * @param string  $delimiter
     * @access public
     * @return array
     */
    public function explode($delimiter = ","){
        return explode($delimiter, $this->value);
    }    
    
    /**
     * The getEncoding method, by default it is UTF-8.
     * @access public
     * @return String
     */
    public function getEncoding(){
        return new String("UTF-8");
    }    
    
    /**
     * The hashCode method, generates a hash code for the string object.
     * @access public
     * @return Int
     */	
	public function hashCode(){	    
        if(!$this->hash){
            $this->hash = 0;
            $this->count = $this->count();
		    $offset = $this->getOffset();
            for($i = 0; $i < $this->count; $i++){
                $this->hash = 31*$this->hash + ord($this->value[$offset++]);             
            }
        }
        return $this->hash;
    }
    
    /**
     * The indexOf method, returns the index of the first occurance of $substr in the string.
     * In case $substr is not a substring of the string, returns false.
     * @param Objective  $substr
     * @param Int  $offset
     * @access public
     * @return Integer/Boolean
     */
    public function indexOf(Objective $substr, Int $offset = NULL){
        $offset = ($offset)?$offset():0;
        $pos = strpos($this->value, (string)$substr, $offset);
        return ($pos === FALSE)?new Integer(-1):new Integer($pos);
    }    

	/**
     * The initialize method, completes string construction with given credentials
     * @param Objective  $string
     * @access private
     * @return Void
     */	    
    private function initialize(Objective $string){
        if($string instanceof String) $this->initWithString($string);
        elseif($string instanceof Char) $this->initWithChar($string);
        elseif($string instanceof Arrays) $this->initWithChars($string);
        elseif($string instanceof Objective) $this->initWithObject($string);
        else throw new IllegalArgumentException("Cannot create a string with the given credential");
    }

	/**
     * The initWithChar method, constructs string object with a given character.
     * @param Char  $char
     * @access private
     * @return Void
     */	    
    private function initWithChar(Char $char){
        $this->count = 1;
        $this->value = (string)$char;
    }     
    
	/**
     * The initWithChars method, constructs string object with a given char array.
     * @param Arrays  $chars
     * @access private
     * @return Void
     */	    
    private function initWithChars(Arrays $chars){
        $this->chars = $chars;
        $this->initWithString($chars->toString());
    }        
    
	/**
     * The initWithObject method, constructs string object with a given object.
     * @param Objective  $object
     * @access private
     * @return Void
     */	    
    private function initWithObject(Objective $object){
        $this->value = (string)$object;        
        $this->count = count($this->value);
    }     
    
	/**
     * The initWithString method, constructs string object with a given string.
     * @param String  $string
     * @access private
     * @return Void
     */	    
    private function initWithString(String $string){
        $this->count = $string->count();
        $this->offset = $string->getOffset();
        $this->value = $string->getValue();
    } 
    
    /**
     * The insert method, inserts another string into this string.
     * @param Int  $offset
     * @param Primitive  $string
     * @access public
     * @return Void
     */      
    public function insert(Int $offset, Primitive $string){
        return $this->splice($offset, new Integer(0), $string);
    }
    
    /**
     * The isBlank method, checks if the string is empty or whitespace-only.
     * @access public
     * @return Boolean
     */
    public function isBlank(){
        return ($this->trim()->value === '');
    }
    
    /**
     * The isEmpty method, checks if the string is empty.
     * @access public
     * @return Boolean
     */
    public function isEmpty(){
        return ($this->value === '');
    } 
    
    /**
     * The isLowerCase method, checks if the string is lower case.
     * String is considered lower case if all the characters are lower case.
     * @access public
     * @return Boolean
     */
    public function isLowerCase(){
        return $this->equals($this->toLowerCase());
    }
    
    /**
     * The isNotBlank method, checks if the string is not empty or whitespace-only.
     * @access public
     * @return Boolean
     */
    public function isNotBlank(){
        return ($this->trim()->value !== '');
    }
    
    /**
     * The isNotEmpty method, checks if the string is not empty.
     * @access public
     * @return Boolean
     */
    public function isNotEmpty(){
        return ($this->value !== '');
    }
    
    /**
     * The isPalindrome, checks if the string is palindrome.
     * @access public
     * @return Boolean
     */
    public function isPalindrome(){
        return ($this->equals($this->reverse()));
    }
    
	/**
     * The isString method, checks if the object is a string or not.
     * @access public
     * @return Boolean
     */
	public function isString(){
	    return TRUE;
	}     
    
    /**
     * The isUnicase method, checks is the string is unicase.
     * Unicase string is one that has no case for its letters.
     * @access public
     * @return Boolean
     */
    public function isUnicase(){
        return $this->toLowerCase()->equals($this->toUpperCase());
    }
    
    /**
     * The isUpperCase method, checks if the string is upper case.
     * String is considered upper case if all the characters are upper case.
     * @access public
     * @return Boolean
     */
    public function isUpperCase(){
        return $this->equals($this->toUpperCase());
    }
    
    /**
     * The isZero method, checks if the string is zero.
     * @access public
     * @return Boolean
     */
    public function isZero(){
        return ($this->value == '0');
    }    
    
    /**
     * The key method, return the key of the current element.
     * @access public
     * @return Integer
     */
    public function key(){
        return new Integer($this->offset);
    }
    
    /**
     * The lastIndexOf method, returns the index of the last occurance of $substr in the string.
     * In case $substr is not a substring of the string, returns false.
     * @param Objective  $substr 
     * @param Int  $offset
     * @access public
     * @return Integer/Boolean
     */
    public function lastIndexOf(Objective $substr, Int $offset = NULL){
        $offset = ($offset)?$offset():0;
        $pos = strrpos($this->value, (string)$substr, $offset);
        return ($pos === FALSE)?new Integer(-1):new Integer($pos);
    }
    
    /**
     * The left method, fetches the leftmost $length characters of a string.
     * @param Int  $length
     * @access public
     * @return String
     */
    public function left(Int $length){
        return $this->substring(new Integer(0), $length);
    }
    
    /**
     * The length method, alias to method getLength().
     * @access public
     * @return Integer
     */	
    public function length(){
	    return $this->getLength();
	}     
    
   /**
     * The matches method, evaluates if the string matches a given pattern.
     * @param String  $pattern
     * @access public
     * @return Boolean
     */      
    public function matches(String $pattern){
        return preg_match((string)$pattern, $this->value);
    }
    
   /**
     * The naturalCompareTo method, carries out natural comparison.
     * @param String  $string
     * @access public
     * @return Int
     */        
    public function naturalCompareTo(String $string){
        return strnatcmp($this->value, (string)$string);
    }

   /**
     * The naturalCompareToIgnoreCase method, carries out natural comparison with case insensitive.
     * @param String  $string
     * @access public
     * @return Int
     */        
    public function naturalCompareToIgnoreCase(String $string){
        return strnatcasecmp($this->value, (string)$string);
    }
    
    /**
     * The next method, moves forward to the next element.
     * @access public
     * @return Void
     */
    public function next(){
        $this->offset++;
    }
    
    /**
     * The offsetExists method, checks if the string contains character at $offset.
     * @param int $offset
     * @access public
     * @return Boolean
     */
    public function offsetExists($offset){
        if(!is_int($offset)) $offset = $offset();        
        return ($offset >= 0 and $offset < $this->count());
    }
    
    /**
     * The offsetGet method, provides array access for accessing characters.
     * @param Int  $offset 
     * @access public
     * @return String
     */
    public function offsetGet($offset){
        if(!is_int($offset)) $offset = $offset();
        return $this->charAt($offset);
    }
    
    /**
     * The offsetSet method, attempts to set a char at given string index.
     * String is immutable. Calling this method will result in an exception.
     * @param int  $offset
     * @param string  $value
     * @access public
     * @return Void
     * @throws IllegalStateException
     */
    public function offsetSet($offset, $value){
        throw new IllegalStateException;
    }
    
    /**
     * The offsetUnset method, attempts to unset a char at given string index.
     * String is immutable. Calling this method will result in an exception.
     * @param int  $offset
     * @param string  $value
     * @access public
     * @return Void
     * @throws IllegalStateException
     */
    public function offsetUnset($offset){
        throw new IllegalStateException;
    }
    
    /**
     * The pad method, fetches the input string padded at both directions.
     * @param Int  $length
     * @param String  $padding
     * @access public
     * @return String
     */    
    public function pad(Int $length, String $padding = NULL){
        if(!$padding) $padding = self::Space;
        return new static(str_pad($this->value, $length(), (string)$padding, STR_PAD_BOTH));
    }
  
    /**
     * The padEnd method, fetches the input string padded at the right direction.
     * @param Int  $length
     * @param String  $padding
     * @access public
     * @return String
     */       
    public function padEnd(Int $length, String $padding = NULL){
        if(!$padding) $padding = self::Space;        
        return new static(str_pad($this->value, $length(), (string)$padding, STR_PAD_RIGHT));
    }
    
    /**
     * The padStart method, fetches the input string padded at the left direction.
     * @param Int  $length
     * @param String  $padding
     * @access public
     * @return String
     */       
    public function padStart(Int $length, String $padding = NULL){
        if(!$padding) $padding = self::Space;        
        return new static(str_pad($this->value, $length(), (string)$padding, STR_PAD_LEFT));
    }    
    
    /**
     * The remove method, removes all occurrences of a substring from the string.
     * @param Objective  $substr 
     * @access public
     * @return String
     */
    public function remove(Objective $substr){
        return $this->replace($substr);
    }
    
    /**
     * The removeAll method, removes all occurrences of a an array of substrings from the string.
     * @param Arrays  $array
     * @access public
     * @return String
     */
    public function removeAll(Arrays $array){
        return $this->replaceAll($array);
    }    

    /**
     * The removeSpaces method, removes blank spaces from the string.
     * @access public
     * @return String
     */    
    public function removeSpaces(){
        $this->removeAll($this->getSpaces());
    }
    
    /**
     * The repeat method, repeats the string $multiplier times.
     * If seperator is not null, it will seperate the repeated string.
     * @param Objective  $separator
     * @param Int  $multiplier 
     * @access public
     * @return String
     */
    public function repeat(Objective $separator = NULL, Int $multiplier = NULL){
        $multiplier = ($multiplier)?$multiplier():0; 
        if ($multiplier === 0) $string = '';
		elseif(!$separator) $string = str_repeat($this->value, $multiplier);
		else $string = str_repeat($this->value.(string)$separator, $multiplier - 1) . $this->value;
        return new static($string);
    }
   
    /**
     * The replace method, replaces a substring with a specified new substring.
     * @param Objective  $search
     * @param Objective  $replace
     * @access public
     * @return String
     */    
    public function replace(Objective $search, Objective $replace = NULL){
        $string = str_replace((string)$search, (string)$replace, $this->value);
        return new static($string);
    }
    
    /**
     * The replaceAll method, replaces an array of substring with a specified new substring.
     * @param Arrays  $search
     * @param Objective  $replace
     * @access public
     * @return String
     */    
    public function replaceAll(Arrays $search, Objective $replace = NULL){
        $string = str_replace($search->toArray(), (string)$replace, $this->value);
        return new static($string);
    }    
    
    /**
     * The replaceChar method, replaces a character with a specified new character.
     * @param Char $search
     * @param Char  $replace
     * @access public
     * @return String
     */    
    public function replaceChar(Char $search, Char $replace){
        $string = str_replace((string)$search, (string)$replace, $this->value);
        return new static($string);
    }    
    
    /**
     * The reverse method, revereses a string.
     * @access public
     * @return String
     */
    public function reverse(){
        return new static(strrev($this->value));
    }
    
    /**
     * The rewind method, rewind the String Iterator to the first element.
     * @access public
     * @return Void
     */
    public function rewind(){
        $this->offset = 0;
    }
    
    /**
     * The right method, returns the rightmost $length characters of a string.
     * @param Int  $length
     * @access public
     * @return String
     */
    public function right(Int $length){
        return $this->substring(new Integer($length() * -1));
    }
    
    /**
     * The shuffle method, shuffles a string randomly.
     * One permutation of all possible is created.
     * @access public
     * @return String
     */
    public function shuffle(){
        return new static(str_shuffle($this->value));
    }
    
    /**
     * The splice method, removes a part of the string and replace it with something else.
     * @param Int  $offset
     * @param Int  $length
     * @param Objective  $replacement
     * @return String
     */
    public function splice(Int $offset, Int $length = NULL, Objective $replacement = NULL){
        $count = $this->count();
        $len = ($length)?$length():NULL;
        $replacement = ($replacement)?(string)$replacement:'';
        
        if($offset->isNegative()) $offset += $count;
        if(!$len) $len = $count;
		elseif($len < 0) $len += $count - $offset();
        return new static((string)$this->substring(new Integer(0), $offset).(string)$replacement.
                          (string)$this->substring($offset->plus(new Integer($len))));
    }     
    
    /**
     * The split method, convert a string to an array based on the delimiter provided.
     * Different from explode, it returns a String Array object rather than PHP array.
     * @param Objective  $delimiter
     * @access public
     * @return Arrays
     */    
    public function split(Objective $delimiter){
        $array = $this->explode((string)$delimiter);
        $count = count($array);
        $strings = new Arrays($count);
        for($i = 0; $i < $count; $i++){
            $strings[$i] = new static($array[$i]);
        }
        return $strings;
    }
    
    /**
     * The squeeze method, removes extra spaces and reduces string's length.
     * Extra spaces are repeated, it will also convert all spaces to white-spaces.
     * @access public
     * @return String
     */
    public function squeeze(){
        return $this->replace($this->getSpaces(), new String(' '))
                    ->removeDuplicates(' ')->trim();
    }
    
    /**
     * The startsWith method, checks if the string starts with a substring.
     * @param Objective  $substr
     * @access public
     * @return Boolean
     */
    public function startsWith(Objective $substr){
        return ($this->indexOf($substr)->isZero());
    }
    
    /**
     * The substring method, returns part of the string.
     * @param Int  $start
     * @param Int  $length
     * @access public
     * @return String
     */
    public function substring(Int $start, Int $length = NULL){
        $start = $start();
        $length = ($length)?$length():NULL;
        return new static(substr($this->value, $start, $length));
    }
    
    /**
     * The substringAfterFirst method, gets the substring after the first occurrence of a separator.
     * If no match is found returns NULL.
     * @param Objective  $separator
     * @param Boolean  $inclusive 
     * @access public
     * @return String
     */
    public function substringAfterFirst(Objective $separator, $inclusive = FALSE){
        $incString = strstr($this->value, (string)$separator);
        if($incString === FALSE) return NULL;
        $string = new static($incString);
        if($inclusive) return $string;
        return $string->substring(new Integer(1));
        
    }
    
    /**
     * The substringAfterLast method, gets the substring after the last occurrence of a separator.
     * If no match is found returns NULL.
     * @param Objective  $separator
     * @param Boolean  $inclusive 
     * @access public
     * @return String
     */
    public function substringAfterLast(Objective $separator, $inclusive = FALSE){
        $incString = strrchr($this->value, (string)$separator);
        if($incString === FALSE) return NULL;
        $string = new static($incString);
        if($inclusive) return $string;
        return $string->substring(new Integer(1));
    }
    
    /**
     * The substringBeforeFirst, gets the substring before the first occurrence of a separator.
     * If no match is found returns NULL.
     * @param Objective  $separator
     * @param Boolean  $inclusive 
     * @access public
     * @return String
     */
    public function substringBeforeFirst(Objective $separator, $inclusive = FALSE){   
        $excString = strstr($this->value, (string)$separator, TRUE);
        if($excString === FALSE) return NULL;
        $string = new static($excString);
        if($inclusive) return $string->concat($separator);
        return $string;
    }
    
    /**
     * The substringBeforeLast, gets the substring before the last occurrence of a separator.
     * If no match is found returns NULL.
     * @param Objective  $separator
     * @param Boolean  $inclusive 
     * @return String
     */
    public function substringBeforeLast(Objective $separator, $inclusive = FALSE){
        $index = $this->lastIndexOf($separator);
        if(!$index) return NULL;
        if($inclusive) $index->next();
        return $this->substring(new Integer(0), $index);
    }
    
    /**
     * The substringBetween method, gets the String that is nested in between two Strings.
     * If one of the delimiters is null, it will use the other one.
     * Only the first match will be returned. If no match is found returns null.
     * @param Objective  $left  
     * @param Objective  $right 
     * @access public
     * @return String
     */
    public function substringBetween(Objective $left = NULL, Objective $right = NULL){
        if(!$left and !$right) return NULL;
        if(!$left) $left = $right;
		if(!$right) $right = $left;
        
        $indexLeft  = $this->indexOf($left);
        if(!$indexLeft) return NULL;
        $indexLeft->increment($left->getLength());
        
        $indexRight = $this->indexOf($right, $indexLeft->succ());
        if(!$indexRight) return NULL;
        return $this->substring($indexLeft, $indexRight->minus($indexLeft));
    }
    
    /**
     * The substringCount method, count the number of substring occurrences.
     * @param Objective  $substr
     * @access public
     * @return Integer
     */
    public function substringCount(Objective $substr){
        return new Integer(substr_count($this->value, (string)$substr));
    }
    
    /**
     * The substringReplace method, replaces a portion of this string by a substring.
     * @param Int  $start
     * @param Int  $length
     * @param Objective  $replacement
     * @access public
     * @return Integer
     */    
    public function substringReplace(Int $start, Int $length = NULL, Objective $replacement = NULL){
        $start = $start();
        $length = ($length)?$length():NULL;
        $replacement = ($replacement)?(string)$replacement:'';
        return new static(substr_replace($this->value, $replacement, $start, $length));
    }
    
    /**
     * The substringSplit method, convert a string to an array with given length of substrings.
     * @param Int  $length
     * @access public
     * @return Strings
     */    
    public function substringSplit(Int $length){
        $array = str_split($this->value, $length());
        $count = count($array);
        $strings = new Arrays\Strings;
        for($i = 0; $i < $count; $i++){
            $strings[$i] = new static($array[$i]);
        }
        return $strings;
    }    
    
    /**
     * The swapCase method, converts uppercase characters lowercase and vice versa.
     * @access public
     * @return String
     */
    public function swapCase(){
        $string = '';
        $length = $this->length()->getValue();
        for($i = 0; $i < $length; $i++) {
            $char = new String($this->charAt($i));
            if($char->isLowerCase()) $string .= $char->toUpperCase();
			else $string .= $char->toLowerCase();
        }
        return new static($string);
    } 
    
    /**
     * The toArray method, converts the string to a PHP built-in array.
     * Each element in the array contains one character.
     * @access public
     * @return array
     */
    public function toArray(){
        return str_split($this->value, 1);
    }    
    
    /**
     * The toCharArray method, converts the string to a char array.
     * Different from toArray(), this method returns a specialized CharArray Object.
     * @access public
     * @return Arrays
     */	
    public function toCharArray(){
        $count = $this->count();
        $chars = new Arrays($count);
        for($i = 0; $i < $count; $i++){
            $chars[$i] = new Char($this[$i]);
        }
        return $chars;
	}
    
    /**
     * The toJson method, returns JSON representation of the string.
     * @access public
     * @return string
     */
     public function toJson(){
        return json_encode($this->value);
     }
     
    /**
     * The toLowerCase method, converts a string to lower case.
     * @access public
     * @return String
     */
    public function toLowerCase(){
        return new static(strtolower($this->value));
    }
    
    /**
     * The toString method, returns the actual string object.
     * It can be used to enforce type safety when the variable type is unclear.
     * @access public
     * @return String
     */
    public function toString(){
        return clone $this;
    }
    
    /**
     * The toUpperCase method, converts a string to upper case.
     * @access public
     * @return String
     */
    public function toUpperCase(){
        return new static(strtoupper($this->value));
    }
    
    /**
     * The trim method, removes characters from both parts of the string.
     * If $charlist is not provided, the default is to remove spaces.
     * @param String  $charlist
     * @access public
     * @return String
     */
    public function trim(String $charlist = NULL){
        return new static(trim($this->value, $charlist));
    }
    
    /**
     * The trimEnd method, removes characters from the right part of the string.
     * If $charlist is not provided, the default is to remove spaces.
     * @param string  $charlist 
     * @access public
     * @return String
     */
    public function trimEnd(String $charlist = NULL){
        return new static(rtrim($this->value, (string)$charlist));
    }
    
    /**
     * The trimStart method, removes characters from the left part of the string.
     * If $charlist is not provided, the default is to remove spaces.
     * @param String  $charlist 
     * @access public
     * @return String
     */
    public function trimStart(String $charlist = NULL){
        return new static(ltrim($this->value, $charlist));
    } 
    
    /**
     * The uncapitalize method, uncapitalizes a string.
     * It changes the first letter to lowercase.
     * @access public
     * @return String
     */
    public function uncapitalize(){
		$string = strtolower(substr($this->value, 0, 1)) . substr($this->value, 1);
        return new static($string);
    }
    
    /**
     * The valid method, checks if current position is valid.
     * @access public
     * @return Boolean
     */
    public function valid(){
        return ($this->offset >= 0 && $this->offset < $this->length());
    }
    
    /**
     * The valueOf method, returns the literal value of the string/
     * It's alias to the value object method getValue().
     * @access public
     * @return string
     */
    public function valueOf(){
        return $this->value;
    }    
    
    /**
     * Magic method __call() for String class, delegates to the callback method.
     * @param string  $name
     * @param array  $args
     * @access public
     * @return String
     */
    public function __call($name, $args){
        return $this->callback($name, $args);
    }
    
   /**
     * Matic method __get() for String class, provides special accessible properties.
     * @param string  $key
     * @access public
     * @return mixed
     * @throws IllegalArgumentException
     */
    public function __get($key){
        $key = strtolower($key);
        if ($key === "encoding") return $this->getEncoding();        
        if ($key === "length") return $this->getLength();
        throw new IllegalArgumentException('Undefined property specified.');
    }
    
	/**
     * Magic method __invoke() for String class, it returns the primitive data value for manipulation.
     * @access public
     * @return String
     */
    public function __invoke(){
        return $this->value;  
    }       
    
    /**
     * Magic method __toString() for string class, returns the literal value of the string.
     * Useful for string operations like printing and concatenation.
     * @access public
     * @return string
     */
    public function __toString(){
        return $this->value;
    }    
}
?>
