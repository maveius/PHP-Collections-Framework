<?php

namespace Mysidia\Resource\Native;

use Serializable;

/**
 * The Objective Interface, extending from Serializable Interfaces.
 *
 * It defines a standard interface for Mysidia Objects, the root class Object
 * also implements this interface.
 *
 * This interface is very useful for classes that extend from PHP's built-in
 * classes, as they cannot extend from root Object Class.
 *
 * By Implementing Objective interface, objects of the specific class can be
 * used in Collections Framework.
 *
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Objective extends Serializable
{
    /**
     * The equals method, checks whether target object is equivalent to this
     * one.
     *
     * @access public
     *
     * @param Objective $object
     *
     * @return bool
     */
    public function equals(Objective $object);

    /**
     * The getClassName method, returns class name of an instance.
     *
     * The return value may differ depending on child classes.
     *
     * @access public
     *
     * @return String
     */
    public function getClassName();

    /**
     * Magic method __clone() for Object Class, returns a copy of Object with
     * additional operations.
     *
     * @access public
     *
     * @return $this
     */
    public function __clone();

    /**
     * Magic method __toString() for Object class, returns object information.
     *
     * @access public
     *
     * @return string
     */
    public function __toString();
}
