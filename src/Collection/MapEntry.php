<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Native\Objective;

/**
 * The MapEntry Class, extending from the abstract Entry Class.
 * It has full implementation of a MapEntry, though it can still be further extended by child classes.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class MapEntry extends Entry
{
    /**
     * serialID constant, it serves as identifier of the object being MapEntry.
     */
    const SERIALID = "-8499721149061103585L";

    /**
     * Constructor of MapEntry Class, it initializes an MapEntry with a key and a value.
     *
     * @param Objective $key
     * @param Objective $value
     *
     * @access public
     * @return Void
     */
    public function __construct(Objective $key = null, Objective $value = null)
    {
        parent::__construct($key, $value);
    }

    /**
     * The hashCode method, returns the hash code for this MapEntry.
     * Note the hashCode for a MapEntry is an integer.
     * @access public
     * @return Int
     */
    public function hashCode()
    {
        $keyHash = ($this->key == null) ? 0 : $this->key->hashCode();
        $valueHash = ($this->value == null) ? 0 : $this->value->hashCode();

        return ($keyHash ^ $valueHash);
    }

    /**
     * The initialize method, initializes properties of this MapEntry from another Entry.
     *
     * @param Entry $entry
     *
     * @access public
     * @return Boolean
     */
    public function initialize(Entry $entry)
    {
        $this->key = $entry->getKey();
        $this->value = $entry->getValue();

        return true;
    }
}
