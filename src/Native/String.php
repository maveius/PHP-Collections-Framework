<?php

namespace Mysidia\Resource\Native;

use InvalidArgumentException;
use Iterator;
use Mysidia\Resource\Exception\IllegalStateException;
use Mysidia\Resource\Native\Integer as BooleanObject;
use Mysidia\Resource\Native\Integer as IntegerObject;
use Mysidia\Resource\Native\String as StringObject;
use Mysidia\Resource\Valuable;
use Serializable;

/**
 * The String Class, extending from the root Object class.
 *
 * This class serves as a wrapper class for primitive data type string.
 *
 * In Mysidia, String can have subclasses depending on the extension used.
 *
 * @category  Resource
 * @package   Native
 * @author    Hall of Famer
 * @copyright Mysidia Adoptables Script
 * @link      http://www.mysidiaadoptables.com
 * @since     1.4.0
 */
class String extends Object implements Iterator, Serializable
{
    /**
     * Alphabetic constant, wraps a string literal of available alphabetic
     * chars.
     */
    const Alphabetic = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    /**
     * AlphaNumeric constant, specifies a collection of available alphanumeric
     * chars.
     */
    const AlphaNumeric = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    /**
     * LineBreak constant, defines the line break character.
     */
    const LineBreak = PHP_EOL;

    /**
     * Numeric constant, contains a list of available number chars.
     */
    const Numeric = "0123456789";

    /**
     * Space constant, defines the space char.
     */
    const Space = " ";

    /**
     * The chars property, it stores the character array inside string object.
     *
     * @access protected
     *
     * @var Arrays
     */
    protected $chars;

    /**
     * The hash property, it defines the hash code of this particular string.
     *
     * @access protected
     *
     * @var int
     */
    protected $hash;

    /**
     * The length property, its an integer object representation of property
     * $count.
     *
     * @access protected
     *
     * @var int
     */
    protected $length = 0;

    /**
     * The offset property, it specifies the first index of storage that is
     * used.
     *
     * @access protected
     *
     * @var int
     */
    protected $offset = 0;

    /**
     * The spaces property, it stores an array of all white space characters.
     *
     * @access protected
     *
     * @var array
     */
    protected $spaces;

    /**
     * The value property, it stores the internal string literal.
     *
     * @access protected
     *
     * @var string
     */
    protected $value = "";

    /**
     * {@inheritdoc}
     */
    public function __construct($value = "")
    {
        $this->initialize($this->coerce($value));
    }

    /**
     * The initialize method, completes string construction with given
     * credentials.
     *
     * @access private
     *
     * @param mixed $object
     *
     * @throws InvalidArgumentException
     */
    private function initialize($object)
    {
        if (is_string($object)) {
            $this->initWithScalarString($object);
        } elseif ($object instanceof StringObject) {
            $this->initWithString($object);
        } elseif ($object instanceof Char) {
            $this->initWithChar($object);
        } elseif ($object instanceof Arrays) {
            $this->initWithChars($object);
        } elseif ($object instanceof Valuable) {
            $this->initWithObject($object);
        } else {
            throw new InvalidArgumentException("Cannot create a string with the given credential");
        }
    }

    /**
     * The initWithScalarString method, constructs string object with a given
     * string.
     *
     * @access private
     *
     * @param string $string
     */
    private function initWithScalarString($string)
    {
        $this->length = strlen($string);
        $this->offset = 0;
        $this->value = $string;
    }

    /**
     * The initWithString method, constructs string object with a given string.
     *
     * @access private
     *
     * @param StringObject $string
     */
    private function initWithString(StringObject $string)
    {
        $this->length = $string->getLength();
        $this->offset = $string->getOffset();
        $this->value = $string->getValue();
    }

    /**
     * The getValue method, getter method for property $length.
     *
     * @access public
     *
     * @return IntegerObject
     */
    public function getLength()
    {
        return new IntegerObject($this->length);
    }

    /**
     * The getOffset method, getter method for property $offset.
     *
     * @access public
     *
     * @return IntegerObject
     */
    public function getOffset()
    {
        return new IntegerObject($this->offset);
    }

    /**
     * The initWithChar method, constructs string object with a given character.
     *
     * @access private
     *
     * @param Char $char
     */
    private function initWithChar(Char $char)
    {
        $this->length = 1;

        $this->value = (string) $char;
    }

    /**
     * The initWithChars method, constructs string object with a given char
     * array.
     *
     * @access private
     *
     * @param Arrays $chars
     */
    private function initWithChars(Arrays $chars)
    {
        $this->chars = $chars;

        $this->initWithString($chars->toString());
    }

    /**
     * The initWithObject method, constructs string object with a given object.
     *
     * @access private
     *
     * @param Valuable $object
     */
    private function initWithObject(Valuable $object)
    {
        $this->value = (string) $object->getValue();

        $this->length = strlen((string) $this->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if (is_scalar($value) or is_null($value)) {
            $value = (string) $value;
        }

        return $value;
    }

    /**
     * The getChars method, getter method for property $chars.
     *
     * @access public
     *
     * @return array
     */
    public function getChars()
    {
        if (!$this->chars) {
            $this->chars = $this->toCharArray();
        }

        return $this->chars;
    }

    /**
     * The toCharArray method, converts the string to a char array.
     * Different from toArray(), this method returns a specialized CharArray
     * Object.
     *
     * @access public
     *
     * @return Arrays
     */
    public function toCharArray()
    {
        $count = (integer) $this->getLength()->getValue();

        $chars = new Arrays($count);

        for ($i = 0; $i < $count; $i++) {
            $chars[$i] = new Char($this[$i]);
        }

        return $chars;
    }

    /**
     * The capitalize method, capitalizes this given string.
     *
     * @access public
     *
     * @return String
     */
    public function capitalize()
    {
        return new static(
            ucfirst((string) $this->getValue())
        );
    }

    /**
     * {@inheritdoc}
     */
    public function compareTo(Valuable $object)
    {
        return strcmp(
            (string) $this->getValue(), (string) $object->getValue()
        );
    }

    /**
     * The contains method, checks if the string contains a substring.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return BooleanObject
     */
    public function contains(StringObject $string)
    {
        return new BooleanObject(
            $this->indexOf($string)->getValue() !== -1
        );
    }

    /**
     * The indexOf method, returns the index of the first occurrence of $string
     * in the string. In case $string is not a substring of the string, returns
     * false.
     *
     * @access public
     *
     * @param StringObject  $string
     * @param IntegerObject $offset
     *
     * @return IntegerObject
     */
    public function indexOf(StringObject $string, IntegerObject $offset = null)
    {
        if ($offset === null) {
            $offset = new IntegerObject(0);
        }

        $position = strpos(
            (string) $this->getValue(), (string) $string->getValue(), (integer) $offset->getValue()
        );

        return ($position === false) ? new IntegerObject(-1) : new IntegerObject($position);
    }

    /**
     * The current method, it simply returns the character at current offset.
     *
     * @access public
     *
     * @return Char
     */
    public function current()
    {
        return $this->charAt(
            $this->getOffset()
        );
    }

    /**
     * The charAt method, finds the character at a specified index.
     *
     * @access public
     *
     * @param IntegerObject $index
     *
     * @return Char
     */
    public function charAt(IntegerObject $index)
    {
        return $this->substring((integer) $index->getValue(), 1);
    }

    /**
     * The substring method, returns part of the string.
     *
     * @access public
     *
     * @param IntegerObject      $start
     * @param null|IntegerObject $length
     *
     * @return StringObject
     */
    public function substring(IntegerObject $start, IntegerObject $length = null)
    {
        if ($length !== null) {
            $length = (integer) $length->getValue();
        }

        return new static(
            substr(
                (string) $this->getValue(), (integer) $start->getValue(), $length
            )
        );
    }

    /**
     * The endsWith method, checks if the string ends with a substring.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return BooleanObject
     */
    public function endsWith(StringObject $string)
    {
        return new BooleanObject(
            $this->lastIndexOf($string)->getValue() == (integer) $this->getLength()->getValue() - (integer) $string->getLength()->getValue()
        );
    }

    /**
     * The lastIndexOf method, returns the index of the last occurrence of
     * $object in the string. In case $object is not a substring of the string,
     * returns false.
     *
     * @access public
     *
     * @param StringObject       $string
     * @param null|IntegerObject $offset
     *
     * @return IntegerObject
     */
    public function lastIndexOf(StringObject $string, IntegerObject $offset = null)
    {
        if ($offset === null) {
            $offset = new IntegerObject(0);
        }

        $position = strrpos(
            (string) $this->getValue(), (string) $string->getValue(), (integer) $offset->getValue()
        );

        return ($position === false) ? new IntegerObject(-1) : new IntegerObject($position);
    }

    /**
     * The equalsIgnoreCase method, checks string equality with
     * case-insensitive.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return BooleanObject
     */
    public function equalsIgnoreCase(StringObject $string)
    {
        return new BooleanObject(
            $this->compareToIgnoreCase($string) === 0
        );
    }

    /**
     * The compareToIgnoreCase method, carries out case-insensitive comparison
     * for strings.
     *
     * @access public
     *
     * @param StringObject $object
     *
     * @return int
     */
    public function compareToIgnoreCase(StringObject $object)
    {
        return strcasecmp(
            (string) $this->getValue(), (string) $object->getValue()
        );
    }

    /**
     * The hashCode method, generates a hash code for the string object.
     *
     * @access public
     *
     * @return IntegerObject
     */
    public function hashCode()
    {
        if (!$this->hash) {
            $this->hash = 0;

            $offset = $this->getOffset();

            for ($i = 0; $i < $this->count; $i++) {
                $this->hash = 31 * $this->hash + ord($this->value[$offset++]);
            }

            $this->hash = new IntegerObject((integer) $this->hash);
        }

        return $this->hash;
    }

    /**
     * The insert method, inserts another string into this string.
     *
     * @access public
     *
     * @param IntegerObject $offset
     * @param StringObject  $string
     *
     * @return StringObject
     */
    public function insert(IntegerObject $offset, StringObject $string)
    {
        return $this->splice($offset, new Integer(0), $string);
    }

    /**
     * The splice method, removes a part of the string and replace it with
     * something else.
     *
     * @param IntegerObject $offset
     * @param IntegerObject $length
     * @param StringObject  $replacement
     *
     * @return StringObject
     */
    public function splice(IntegerObject $offset, IntegerObject $length = null, StringObject $replacement = null)
    {
        $count = (integer) $this->getLength()->getValue();

        $len = null;

        if ($length !== null) {
            $len = (integer) $length->getValue();
        }

        $replacement = ($replacement) ? (string) $replacement : '';

        if ($offset->isNegative()) {
            $offset = new Integer((integer) $offset->getValue() + $count);
        }

        if ($len === null) {
            $len = $count;
        }

        if ($len !== null and $len < 0) {
            $len += $count - (integer) $offset->getValue();
        }

        return new static(
            (string) $this->substring(new Integer(0), $offset).(string) $replacement->getValue().(string) $this->substring($offset->plus(new Integer($len))->getValue())
        );
    }

    /**
     * The isBlank method, checks if the string is empty or whitespace-only.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isBlank()
    {
        return new BooleanObject(
            (string) $this->trim()->getValue() === ""
        );
    }

    /**
     * The trim method, removes characters from both parts of the string.
     *
     * If $mask is not provided, the default is to remove spaces.
     *
     * @access public
     *
     * @param StringObject $mask
     *
     * @return StringObject
     */
    public function trim(StringObject $mask = null)
    {
        if ($mask !== null) {
            $mask = (string) $mask->getValue();
        }

        return new static(
            trim(
                (string) $this->getValue(), $mask
            )
        );
    }

    /**
     * The isEmpty method, checks if the string is empty.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isEmpty()
    {
        return new BooleanObject(
            (string) $this->getValue() === ""
        );
    }

    /**
     * The isNotBlank method, checks if the string is not empty or
     * whitespace-only.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isNotBlank()
    {
        return new BooleanObject(
            (string) $this->trim()->getValue() !== ""
        );
    }

    /**
     * The isNotEmpty method, checks if the string is not empty.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isNotEmpty()
    {
        return new BooleanObject(
            (string) $this->getValue() !== ""
        );
    }

    /**
     * The isPalindrome, checks if the string is palindrome.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isPalindrome()
    {
        return $this->equals($this->reverse());
    }

    /**
     * The reverse method, reverses a string.
     *
     * @access public
     *
     * @return StringObject
     */
    public function reverse()
    {
        return new static(
            strrev(
                (string) $this->getValue()
            )
        );
    }

    /**
     * The isString method, checks if the object is a string or not.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isString()
    {
        return new BooleanObject(true);
    }

    /**
     * The isUnicase method, checks is the string is unicase.
     *
     * Unicase string is one that has no case for its letters.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isUnicase()
    {
        return $this->toLowerCase()->equals($this->toUpperCase());
    }

    /**
     * The toLowerCase method, converts a string to lower case.
     *
     * @access public
     *
     * @return StringObject
     */
    public function toLowerCase()
    {
        return new static(
            strtolower(
                (string) $this->getValue()
            )
        );
    }

    /**
     * The toUpperCase method, converts a string to upper case.
     *
     * @access public
     *
     * @return StringObject
     */
    public function toUpperCase()
    {
        return new static(
            strtoupper(
                (string) $this->getValue()
            )
        );
    }

    /**
     * The isUpperCase method, checks if the string is upper case.
     *
     * String is considered upper case if all the characters are upper case.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isUpperCase()
    {
        return $this->equals($this->toUpperCase());
    }

    /**
     * The isZero method, checks if the string is zero.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isZero()
    {
        return new BooleanObject(
            (string) $this->getValue() == "0"
        );
    }

    /**
     * The key method, return the key of the current element.
     *
     * @access public
     *
     * @return IntegerObject
     */
    public function key()
    {
        return new IntegerObject($this->offset);
    }

    /**
     * The left method, fetches the leftmost $length characters of a string.
     *
     * @access public
     *
     * @param IntegerObject $length
     *
     * @return StringObject
     */
    public function left(IntegerObject $length)
    {
        return $this->substring(new IntegerObject(0), $length);
    }

    /**
     * The length method, alias to method getLength().
     *
     * @access public
     *
     * @return IntegerObject
     */
    public function length()
    {
        return $this->getLength();
    }

    /**
     * The matches method, evaluates if the string matches a given pattern.
     *
     * @access public
     *
     * @param StringObject $pattern
     *
     * @return BooleanObject
     */
    public function matches(StringObject $pattern)
    {
        return new BooleanObject(
            preg_match((string) $pattern->getValue(), (string) $this->getValue())
        );
    }

    /**
     * The naturalCompareTo method, carries out natural comparison.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return IntegerObject
     */
    public function naturalCompareTo(StringObject $string)
    {
        return new IntegerObject(
            strnatcmp(
                (string) $this->getValue(), (string) $string->getValue()
            )
        );
    }

    /**
     * The naturalCompareToIgnoreCase method, carries out natural comparison
     * with case insensitive.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return IntegerObject
     */
    public function naturalCompareToIgnoreCase(StringObject $string)
    {
        return new IntegerObject(
            strnatcasecmp(
                (string) $this->getValue(), (string) $string->getValue()
            )
        );
    }

    /**
     * The next method, moves forward to the next element.
     *
     * @access public
     */
    public function next()
    {
        $this->offset++;
    }

    /**
     * The offsetExists method, checks if the string contains character at
     * $offset.
     *
     * @access public
     *
     * @param IntegerObject $offset
     *
     * @return BooleanObject
     */
    public function offsetExists(IntegerObject $offset)
    {
        return new BooleanObject(
            (integer) $offset->getValue() >= 0 and (integer) $offset->getValue() < (integer) $this->getLength()->getValue()
        );
    }

    /**
     * The offsetGet method, provides array access for accessing characters.
     *
     * @access public
     *
     * @param IntegerObject $offset
     *
     * @return StringObject
     */
    public function offsetGet(IntegerObject $offset)
    {
        return $this->charAt($offset);
    }

    /**
     * The offsetSet method, attempts to set a char at given string index.
     *
     * String is immutable.
     *
     * Calling this method will result in an exception.
     *
     * @access public
     *
     * @param IntegerObject $offset
     * @param StringObject  $string
     *
     * @throws IllegalStateException
     */
    public function offsetSet(IntegerObject $offset, StringObject $string)
    {
        throw new IllegalStateException();
    }

    /**
     * The offsetUnset method, attempts to unset a char at given string index.
     *
     * String is immutable.
     *
     * Calling this method will result in an exception.
     *
     * @access public
     *
     * @param IntegerObject $offset
     * @param StringObject  $string
     *
     * @throws IllegalStateException
     */
    public function offsetUnset(IntegerObject $offset, StringObject $string)
    {
        throw new IllegalStateException();
    }

    /**
     * The pad method, fetches the input string padded at both directions.
     *
     * @access public
     *
     * @param IntegerObject     $length
     * @param null|StringObject $padding
     *
     * @return StringObject
     */
    public function pad(IntegerObject $length, StringObject $padding = null)
    {
        if ($padding === null) {
            $padding = static::Space;
        }

        return new static(
            str_pad(
                (string) $this->getValue(), (integer) $length->getValue(), (string) $padding->getValue(), STR_PAD_BOTH
            )
        );
    }

    /**
     * The padEnd method, fetches the input string padded at the right
     * direction.
     *
     * @access public
     *
     * @param IntegerObject     $length
     * @param null|StringObject $padding
     *
     * @return StringObject
     */
    public function padEnd(IntegerObject $length, String $padding = null)
    {
        if ($padding === null) {
            $padding = static::Space;
        }

        return new static(
            str_pad(
                (string) $this->getValue(), (integer) $length->getValue(), (string) $padding->getValue(), STR_PAD_RIGHT
            )
        );
    }

    /**
     * The padStart method, fetches the input string padded at the left
     * direction.
     *
     * @access public
     *
     * @param IntegerObject     $length
     * @param null|StringObject $padding
     *
     * @return StringObject
     */
    public function padStart(IntegerObject $length, String $padding = null)
    {
        if (!$padding) {
            $padding = self::Space;
        }

        return new static(
            str_pad(
                (string) $this->getValue(), (integer) (integer) $length->getValue(), (string) $padding->getValue(), STR_PAD_LEFT
            )
        );
    }

    /**
     * The remove method, removes all occurrences of a substring from the
     * string.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return String
     */
    public function remove(StringObject $string)
    {
        return $this->replace($string);
    }

    /**
     * The replace method, replaces a substring with a specified new substring.
     *
     * @access public
     *
     * @param StringObject $search
     * @param StringObject $replace
     *
     * @return StringObject
     */
    public function replace(StringObject $search, StringObject $replace = null)
    {
        return new static(
            str_replace(
                (string) $search->getValue(), (string) $replace->getValue(), (string) $this->getValue()
            )
        );
    }

    /**
     * The removeSpaces method, removes blank spaces from the string.
     *
     * @access public
     *
     * @return StringObject
     */
    public function removeSpaces()
    {
        return $this->removeAll($this->getSpaces());
    }

    /**
     * The removeAll method, removes all occurrences of an array of
     * strings from a string.
     *
     * @access public
     *
     * @param Arrays $array
     *
     * @return StringObject
     */
    public function removeAll(Arrays $array)
    {
        return $this->replaceAll($array);
    }

    /**
     * The replaceAll method, replaces an array of substring with a specified
     * new substring.
     *
     * @access public
     *
     * @param Arrays       $search
     * @param StringObject $replace
     *
     * @return StringObject
     */
    public function replaceAll(Arrays $search, StringObject $replace = null)
    {
        return new static(
            str_replace(
                $search->toArray(), (string) $replace->getValue(), (string) $this->getValue()
            )
        );
    }

    /**
     * The getSpaces method, getter method for property $spaces.
     *
     * @access public
     *
     * @return Arrays
     */
    public function getSpaces()
    {
        if (!$this->spaces) {
            $spaces = new Arrays(6);

            $spaces[0] = new StringObject(" ");
            $spaces[1] = new StringObject("\r");
            $spaces[2] = new StringObject("\n");
            $spaces[3] = new StringObject("\t");
            $spaces[4] = new StringObject("\0");
            $spaces[5] = new StringObject("\x0B");

            $this->spaces = $spaces;
        }

        return $this->spaces;
    }

    /**
     * The repeat method, repeats the string $multiplier times.
     * If separator is not null, it will separate the repeated string.
     *
     * @access public
     *
     * @param StringObject  $separator
     * @param IntegerObject $multiplier
     *
     * @return StringObject
     */
    public function repeat(StringObject $separator = null, IntegerObject $multiplier = null)
    {
        if ($multiplier === null) {
            $multiplier = new IntegerObject(0);
        }

        $value = (integer) $multiplier->getValue();

        if ($value === 0) {
            $string = "";
        } elseif ($separator == null) {
            $string = str_repeat((string) $this->getValue(), $value);
        } else {
            $string = str_repeat((string) $this->getValue().(string) $separator->getValue(), $value - 1).(string) $this->getValue();
        }

        return new static($string);
    }

    /**
     * The replaceChar method, replaces a character with a specified new
     * character.
     *
     * @access public
     *
     * @param Char $search
     * @param Char $replace
     *
     * @return StringObject
     */
    public function replaceChar(Char $search, Char $replace)
    {
        return new static(
            str_replace(
                (string) $search->getValue(), (string) $replace->getValue(), (string) $this->getValue()
            )
        );
    }

    /**
     * The rewind method, rewind the String Iterator to the first element.
     *
     * @access public
     */
    public function rewind()
    {
        $this->offset = 0;
    }

    /**
     * The right method, returns the rightmost $length characters of a string.
     *
     * @access public
     *
     * @param IntegerObject $length
     *
     * @return StringObject
     */
    public function right(IntegerObject $length)
    {
        return $this->substring(
            new Integer(
                (integer) $length->getValue() * -1
            )
        );
    }

    /**
     * The shuffle method, shuffles a string randomly.
     *
     * One permutation of all possible is created.
     *
     * @access public
     *
     * @return StringObject
     */
    public function shuffle()
    {
        return new static(
            str_shuffle(
                (string) $this->getValue()
            )
        );
    }

    /**
     * The split method, convert a string to an array based on the delimiter
     * provided. Different from explode, it returns a String Array object
     * rather than PHP array.
     *
     * @access public
     *
     * @param StringObject $delimiter
     *
     * @return Arrays
     */
    public function split(StringObject $delimiter)
    {
        $array = $this->explode($delimiter->getValue());

        $count = count($array);

        $strings = new Arrays($count);

        for ($i = 0; $i < $count; $i++) {
            $strings[$i] = new static($array[$i]);
        }

        return $strings;
    }

    /**
     * The explode method, convert a string to an array based on the delimiter
     * provided.
     *
     * @access public
     *
     * @param null|StringObject $delimiter
     *
     * @return array
     */
    public function explode(StringObject $delimiter = null)
    {
        if ($delimiter === null) {
            $delimiter = new StringObject(",");
        }

        return explode((string) $delimiter->getValue(), (string) $this->getValue());
    }

    /**
     * The squeeze method, removes extra spaces and reduces string's length.
     * Extra spaces are repeated, it will also convert all spaces to
     * white-spaces.
     *
     * @access public
     *
     * @return StringObject
     */
    public function squeeze()
    {
        return $this
            ->replace(
                $this->getSpaces()->toString(), new StringObject(" ")
            )
            ->trim();
    }

    /**
     * The startsWith method, checks if the string starts with a substring.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return BooleanObject
     */
    public function startsWith(StringObject $string)
    {
        return new BooleanObject(
            (integer) $this->indexOf($string)->getValue() === 0
        );
    }

    /**
     * The substringAfterFirst method, gets the substring after the first
     * occurrence of a separator.
     *
     * If no match is found returns NULL.
     *
     * @access public
     *
     * @param StringObject       $separator
     * @param null|BooleanObject $inclusive
     *
     * @return null|StringObject
     */
    public function substringAfterFirst(StringObject $separator, BooleanObject $inclusive = null)
    {
        if ($inclusive === null) {
            $inclusive = new BooleanObject(false);
        }

        $incString = strstr((string) $this->getValue(), (string) $separator->getValue());

        if ($incString === false) {
            return;
        }

        $string = new static($incString);

        if ($inclusive) {
            return $string;
        }

        return $string->substring(new Integer(1));
    }

    /**
     * The substringAfterLast method, gets the substring after the last
     * occurrence of a separator. If no match is found returns NULL.
     *
     * @access public
     *
     * @param StringObject       $separator
     * @param null|BooleanObject $inclusive
     *
     * @return null|StringObject
     */
    public function substringAfterLast(StringObject $separator, BooleanObject $inclusive = null)
    {
        if ($inclusive === null) {
            $inclusive = new BooleanObject(false);
        }

        $incString = strrchr((string) $this->getValue(), (string) $separator->getValue());

        if ($incString === false) {
            return;
        }

        $string = new static($incString);

        if ($inclusive) {
            return $string;
        }

        return $string->substring(new Integer(1));
    }

    /**
     * The substringBeforeFirst, gets the substring before the first occurrence
     * of a separator.
     *
     * If no match is found returns NULL.
     *
     * @access public
     *
     * @param StringObject  $separator
     * @param BooleanObject $inclusive
     *
     * @return StringObject
     */
    public function substringBeforeFirst(StringObject $separator, BooleanObject $inclusive = null)
    {
        if ($inclusive === null) {
            $inclusive = new BooleanObject(false);
        }

        $excString = strstr((string) $this->getValue(), (string) $separator->getValue(), true);

        if ($excString === false) {
            return;
        }

        $string = new static($excString);

        if ($inclusive) {
            return $string->concat($separator);
        }

        return $string;
    }

    /**
     * The concat method, concatenates this string by another and returns the
     * combined string.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return String
     */
    public function concat(StringObject $string)
    {
        return new static(
            (string) $this->getValue().(string) $string->getValue()
        );
    }

    /**
     * The substringBeforeLast, gets the substring before the last occurrence
     * of a separator.
     *
     * If no match is found returns NULL.
     *
     * @param StringObject  $separator
     * @param BooleanObject $inclusive
     *
     * @return StringObject
     */
    public function substringBeforeLast(StringObject $separator, BooleanObject $inclusive = null)
    {
        if ($inclusive === null) {
            $inclusive = new BooleanObject(false);
        }

        $index = $this->lastIndexOf($separator);

        if (!$index) {
            return;
        }

        if ($inclusive) {
            $index->next();
        }

        return $this->substring(new Integer(0), $index);
    }

    /**
     * The substringBetween method, gets the String that is nested in between
     * two Strings.
     *
     * If one of the delimiters is null, it will use the other one. Only the
     * first match will be returned.
     *
     * If no match is found returns null.
     *
     * @access public
     *
     * @param StringObject $left
     * @param StringObject $right
     *
     * @return String
     */
    public function substringBetween(StringObject $left = null, StringObject $right = null)
    {
        if (!$left and !$right) {
            return;
        }

        if (!$left) {
            $left = $right;
        }

        if (!$right) {
            $right = $left;
        }

        $indexLeft = $this->indexOf($left);

        if (!$indexLeft) {
            return;
        }

        $indexLeft->increment($left->getLength());

        $indexRight = $this->indexOf($right, $indexLeft->succ());

        if (!$indexRight) {
            return;
        }

        return $this->substring($indexLeft, $indexRight->minus($indexLeft));
    }

    /**
     * The substringCount method, count the number of substring occurrences.
     *
     * @access public
     *
     * @param StringObject $string
     *
     * @return IntegerObject
     */
    public function substringCount(StringObject $string)
    {
        return new IntegerObject(
            substr_count(
                (string) $this->getValue(), (string) $string->getValue()
            )
        );
    }

    /**
     * The substringReplace method, replaces a portion of this string by a
     * substring.
     *
     * @access public
     *
     * @param IntegerObject $start
     * @param IntegerObject $length
     * @param StringObject  $replacement
     *
     * @return IntegerObject
     */
    public function substringReplace(IntegerObject $start, IntegerObject $length = null, StringObject $replacement = null)
    {
        $start = (integer) $start->getValue();

        if ($length !== null) {
            $length = (integer) $length->getValue();
        }

        if ($replacement !== null) {
            $replacement = (string) $replacement->getValue();
        }

        return new static(
            substr_replace(
                (string) $this->getValue(), $replacement, $start, $length
            )
        );
    }

    /**
     * The substringSplit method, convert a string to an array with given
     * length of strings.
     *
     * @access public
     *
     * @param IntegerObject $length
     *
     * @return Arrays
     */
    public function substringSplit(IntegerObject $length)
    {
        $array = str_split((string) $this->getValue(), (integer) $length->getValue());

        $count = count($array);

        $strings = new Arrays($count);

        for ($i = 0; $i < $count; $i++) {
            $strings[$i] = new static($array[$i]);
        }

        return $strings;
    }

    /**
     * The swapCase method, converts uppercase characters lowercase and vice
     * versa.
     *
     * @access public
     *
     * @return StringObject
     */
    public function swapCase()
    {
        $string = "";

        $length = (integer) $this->getLength()->getValue();

        for ($i = 0; $i < $length; $i++) {
            $char = new String($this->charAt(new Integer($i)));
            if ($char->isLowerCase()) {
                $string .= $char->toUpperCase();
            } else {
                $string .= $char->toLowerCase();
            }
        }

        return new static($string);
    }

    /**
     * The isLowerCase method, checks if the string is lower case.
     *
     * String is considered lower case if all the characters are lower case.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function isLowerCase()
    {
        return $this->equals($this->toLowerCase());
    }

    /**
     * The toArray method, converts the string to a PHP built-in array.
     * Each element in the array contains one character.
     *
     * @access public
     *
     * @return array
     */
    public function toArray()
    {
        return str_split((string) $this->getValue(), 1);
    }

    /**
     * The toJson method, returns JSON representation of the string.
     *
     * @access public
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode((string) $this->getValue());
    }

    /**
     * The toString method, returns the actual string object.
     *
     * It can be used to enforce type safety when the variable type is unclear.
     *
     * @access public
     *
     * @return String
     */
    public function toString()
    {
        return clone $this;
    }

    /**
     * The trimEnd method, removes characters from the right part of the string.
     *
     * If $mask is not provided, the default is to remove spaces.
     *
     * @access public
     *
     * @param StringObject $mask
     *
     * @return StringObject
     */
    public function trimEnd(StringObject $mask = null)
    {
        if ($mask !== null) {
            $mask = (string) $mask->getValue();
        }

        return new static(
            rtrim(
                (string) $this->getValue(), $mask
            )
        );
    }

    /**
     * The trimStart method, removes characters from the left part of the
     * string.
     *
     * If $mask is not provided, the default is to remove spaces.
     *
     * @access public
     *
     * @param StringObject $mask
     *
     * @return StringObject
     */
    public function trimStart(String $mask = null)
    {
        if ($mask !== null) {
            $mask = (string) $mask->getValue();
        }

        return new static(
            ltrim(
                (string) $this->getValue(), $mask
            )
        );
    }

    /**
     * The uncapitalize method, uncapitalizes a string.
     *
     * It changes the first letter to lowercase.
     *
     * @access public
     *
     * @return StringObject
     */
    public function uncapitalize()
    {
        return new static(
            strtolower(substr((string) $this->getValue(), 0, 1)).substr((string) $this->getValue(), 1)
        );
    }

    /**
     * The valid method, checks if current position is valid.
     *
     * @access public
     *
     * @return BooleanObject
     */
    public function valid()
    {
        return new BooleanObject(
            $this->getOffset() >= 0 && $this->getOffset() < $this->getLength()
        );
    }

    /**
     * Magic method __call() for String class, delegates to the callback method.
     *
     * @access public
     *
     * @param string     $name
     * @param null|array $parameters
     *
     * @return StringObject
     */
    public function __call($name, array $parameters = array())
    {
        return $this->callback($name, $parameters);
    }

    /**
     * The callback method, carries out callback operation and returns the
     * result.
     *
     * @param mixed $name
     * @param array $parameters
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function callback($name, array $parameters = array())
    {
        if (!is_callable($name)) {
            throw new InvalidArgumentException("Argument name is not a valid callback");
        }

        array_unshift($parameters, (string) $this->getValue());

        $result = call_user_func_array($name, $parameters);

        if (!is_string($result)) {
            return $result;
        }

        return new static($result);
    }

    /**
     * Magic method __get() for String class, provides special accessible
     * properties.
     *
     * @access public
     *
     * @param string $key
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function __get($key)
    {
        $key = strtolower($key);

        if ($key === "encoding") {
            return (string) $this->getEncoding()->getValue();
        }

        if ($key === "length") {
            return (integer) $this->getLength()->getValue();
        }

        throw new InvalidArgumentException("Undefined property specified");
    }

    /**
     * The getEncoding method, by default it is UTF-8.
     *
     * @access public
     *
     * @return StringObject
     */
    public function getEncoding()
    {
        return new StringObject("UTF-8");
    }
}
