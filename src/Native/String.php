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
 * A string type wrapper
 *
 * @author Hall of Famer
 */
class String extends Object implements Iterator, Serializable
{
    /**
     * Stores the character array inside string object
     *
     * @var Arrays
     */
    protected $chars;

    /**
     * Defines the hash code of this particular string
     *
     * @var int
     */
    protected $hash;

    /**
     * Stores the length of the string
     *
     * @var int
     */
    protected $length = 0;

    /**
     * Specifies the first index of storage that is used
     *
     * @var int
     */
    protected $offset = 0;

    /**
     * Stores an array of all white space characters
     *
     * @var array
     */
    protected $spaces;

    /**
     * Stores the internal string literal
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
     * Evaluates string to set cached properties
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
     * Constructs String object from a scalar string
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
     * Constructs String object from a String object
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
     * Returns length
     *
     * @return IntegerObject
     */
    public function getLength()
    {
        return new IntegerObject($this->length);
    }

    /**
     * Returns offset
     *
     * @return IntegerObject
     */
    public function getOffset()
    {
        return new IntegerObject($this->offset);
    }

    /**
     * Constructs String object from a Char object
     *
     * @param Char $char
     */
    private function initWithChar(Char $char)
    {
        $this->length = 1;

        $this->value = (string) $char;
    }

    /**
     * Constructs String object from an Arrays object
     *
     * @param Arrays $arrays
     */
    private function initWithChars(Arrays $arrays)
    {
        $this->chars = $arrays;

        $this->initWithString($arrays->toString());
    }

    /**
     * Constructs String object from a Valuable object
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
     * Returns chars
     *
     * @return Arrays
     */
    public function getChars()
    {
        if (!$this->chars) {
            $this->chars = $this->toCharArray();
        }

        return $this->chars;
    }

    /**
     * Converts the string to a Char array
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
     * Capitalizes the string
     *
     * @return StringObject
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
     * Checks if the string contains a substring
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
     * Returns the index of the first occurrence of a substring in the string
     *
     * Returns -1 if the substring is missing
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
     * Returns the character at the current offset
     *
     * @return StringObject
     */
    public function current()
    {
        return $this->charAt(
            $this->getOffset()
        );
    }

    /**
     * Returns the character at a specified index
     *
     * @param IntegerObject $index
     *
     * @return StringObject
     */
    public function charAt(IntegerObject $index)
    {
        return $this->substring(
            $index, new Integer(1)
        );
    }

    /**
     * Returns part of the string
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
     * Checks if the string ends with a substring
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
     * Returns the index of the last occurrence of a substring in the string
     *
     * Returns -1 of the substring is missing
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
     * Checks case-insensitive string equality
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
     * Compares the string to another  without case sensitivity
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
     * Returns a hash code for the String object
     *
     * @return IntegerObject
     */
    public function hashCode()
    {
        if (!$this->hash) {
            $this->hash = 0;

            $offset = $this->getOffset();

            for ($i = 0; $i < $this->length; $i++) {
                $this->hash = 31 * $this->hash + ord($this->value[$offset++]);
            }

            $this->hash = new IntegerObject((integer) $this->hash);
        }

        return $this->hash;
    }

    /**
     * Inserts a substring into this string
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
     * Replace a substring with another
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
     * Checks if the string is empty or whitespace-only
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
     * Removes characters from both ends of the string
     *
     * Removes spaces if mask is missing
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
     * Checks if the string is empty
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
     * Checks if the string is not empty or whitespace-only
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
     * Checks if the string is not empty
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
     * Checks if the string is a palindrome
     *
     * @return bool
     */
    public function isPalindrome()
    {
        return $this->equals($this->reverse());
    }

    /**
     * Reverses the string
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
     * Checks if the object is a String object
     *
     * @return BooleanObject
     */
    public function isString()
    {
        return new BooleanObject(true);
    }

    /**
     * Checks is the string is unicase
     *
     * @return bool
     */
    public function isUnicase()
    {
        return $this->toLowerCase()->equals($this->toUpperCase());
    }

    /**
     * Converts the string to lower case
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
     * Converts the string to upper case
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
     * Checks if the string is upper case
     *
     * @return bool
     */
    public function isUpperCase()
    {
        return $this->equals($this->toUpperCase());
    }

    /**
     * Checks if the string is zero
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
     * Returns the key of the current element
     *
     * @return IntegerObject
     */
    public function key()
    {
        return new IntegerObject($this->offset);
    }

    /**
     * Returns the leftmost characters of the string
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
     * Returns length
     *
     * @return IntegerObject
     */
    public function length()
    {
        return $this->getLength();
    }

    /**
     * Checks if the string matches a pattern
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
     * Compares strings naturally
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
     * Compares strings naturally without case sensitivity
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
     * Moves to the next element
     *
     * @access public
     */
    public function next()
    {
        $this->offset++;
    }

    /**
     * Checks if the string contains a character at an offset
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
     * Gets a character at an offset
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
     * Sets a character at an offset
     *
     * Calling this method will result in an exception
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
     * Unsets a character at an offset
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
     * Returns the string padded at both ends
     *
     * @param IntegerObject     $length
     * @param null|StringObject $padding
     *
     * @return StringObject
     */
    public function pad(IntegerObject $length, StringObject $padding = null)
    {
        if ($padding === null) {
            $padding = " ";
        }

        return new static(
            str_pad(
                (string) $this->getValue(), (integer) $length->getValue(), (string) $padding->getValue(), STR_PAD_BOTH
            )
        );
    }

    /**
     * Returns the string padded at the right end
     *
     * @param IntegerObject     $length
     * @param null|StringObject $padding
     *
     * @return StringObject
     */
    public function padEnd(IntegerObject $length, String $padding = null)
    {
        if ($padding === null) {
            $padding = " ";
        }

        return new static(
            str_pad(
                (string) $this->getValue(), (integer) $length->getValue(), (string) $padding->getValue(), STR_PAD_RIGHT
            )
        );
    }

    /**
     * Returns the string padded at the left end
     *
     * @param IntegerObject     $length
     * @param null|StringObject $padding
     *
     * @return StringObject
     */
    public function padStart(IntegerObject $length, String $padding = null)
    {
        if (!$padding) {
            $padding = " ";
        }

        return new static(
            str_pad(
                (string) $this->getValue(), (integer) (integer) $length->getValue(), (string) $padding->getValue(), STR_PAD_LEFT
            )
        );
    }

    /**
     * Removes all occurrences of a substring from the string
     *
     * @param StringObject $string
     *
     * @return StringObject
     */
    public function remove(StringObject $string)
    {
        return $this->replace($string);
    }

    /**
     * Replaces a substring with another
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
     * Removes blank spaces from the string
     *
     * @return StringObject
     */
    public function removeSpaces()
    {
        return $this->removeAll($this->getSpaces());
    }

    /**
     * Removes all occurrences of an array of strings from a string
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
     * Replaces an array of substrings with a specified new substring
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
     * Returns spaces
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
     * Returns the string repeated
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
     * Replaces a character with another
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
     * Rewinds the string offset
     *
     * @access public
     */
    public function rewind()
    {
        $this->offset = 0;
    }

    /**
     * Returns the rightmost characters of the string
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
     * Shuffles the string
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
     * Convert a string to an array based on a delimiter
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
     * Converts the string to an array based on a delimiter
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
     * Removes extra spaces
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
     * Checks if the string starts with a substring
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
     * Returns the substring after the first occurrence of a separator
     *
     * Returns null if no match is found
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
     * Returns the substring after the last occurrence of a separator
     *
     * Returns null if no match is found
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
     * Returns the substring before the first occurrence of a separator
     *
     * Returns null if no match is found
     *
     * @param StringObject  $separator
     * @param BooleanObject $inclusive
     *
     * @return null|StringObject
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
     * Concatenates the string with another
     *
     * @param StringObject $string
     *
     * @return StringObject
     */
    public function concat(StringObject $string)
    {
        return new static(
            (string) $this->getValue().(string) $string->getValue()
        );
    }

    /**
     * Returns the substring before the last occurrence of a separator
     *
     * Returns null if no match is found
     *
     * @param StringObject  $separator
     * @param BooleanObject $inclusive
     *
     * @return null|StringObject
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
     * Returns a substring nested in between who others
     *
     * Only the first match is returned
     *
     * Returns null if no match is found
     *
     * @param StringObject $left
     * @param StringObject $right
     *
     * @return null|StringObject
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
     * Counts the number of substring occurrences
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
     * Replaces a substring with another
     *
     * @param IntegerObject $start
     * @param IntegerObject $length
     * @param StringObject  $replacement
     *
     * @return StringObject
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
     * Converts a string to an array
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
     * Swaps the case of characters in the string
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
     * Checks if the string is lower case
     *
     * @return bool
     */
    public function isLowerCase()
    {
        return $this->equals($this->toLowerCase());
    }

    /**
     * Converts the string to a scalar array
     *
     * Each element in the array contains one character
     *
     * @return array
     */
    public function toArray()
    {
        return str_split((string) $this->getValue(), 1);
    }

    /**
     * Returns a JSON representation of the string
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode((string) $this->getValue());
    }

    /**
     * Returns a new String object
     *
     * @return StringObject
     */
    public function toString()
    {
        return clone $this;
    }

    /**
     * Removes characters from the right end of the string
     *
     * Removes spaces is mask is missing
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
     * Removes characters from the left end of the string
     *
     * Removes spaces if mask is missing
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
     * Uncapitalizes the string
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
     * Checks if current position is valid
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
     * Returns encoding
     *
     * @return StringObject
     */
    public function getEncoding()
    {
        return new StringObject("UTF-8");
    }
}
