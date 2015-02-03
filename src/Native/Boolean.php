<?php

namespace Mysidia\Resource\Native;

use Mysidia\Resource\Utility\Comparable;

/**
 * The Boolean Class, extending the root Object class.
 *
 * This class serves as a wrapper class for primitive data type boolean.
 *
 * It is a final class, no child class shall derive from Boolean.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Boolean extends Object implements Comparable
{
    /**
     * The value property, which stores the primitive value for this Boolean
     * object.
     *
     * @access private
     *
     * @var bool
     */
    private $value;

    /**
     * Constructor of Boolean Class, initializes the Boolean wrapper class.
     *
     * If supplied argument is not of boolean type, type casting will be
     * converted.
     *
     * @param mixed $value
     *
     * @access public
     */
    public function __construct($value)
    {
        if ($value !== true and $value !== false) {
            $value = (boolean) $value;
        }

        $this->value = $value;
    }

    /**
     * The getValue method, returns the primitive boolean value.
     *
     * @access public
     *
     * @return Boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * The compareTo method, compares a boolean object to another.
     *
     * @access public
     *
     * @param Objective $target
     *
     * @return int
     */
    public function compareTo(Objective $target)
    {
        return ($this->equals($target)) ? 0 : ($this->value ? 1 : -1);
    }

    /**
     * {@inheritdoc}
     */
    public function getClassName()
    {
        $label = $this->value ? "true" : "false";

        return parent::getClassName()."(".$label.")";
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $label = $this->value ? "true" : "false";

        return parent::__toString()."(".$label.")";
    }

    /**
     * Magic method __invoke() for Boolean class, it returns the primitive data
     * value for manipulation.
     *
     * @access public
     *
     * @return Number
     */
    public function __invoke()
    {
        return $this->value;
    }
}
