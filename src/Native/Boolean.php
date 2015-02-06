<?php

namespace Mysidia\Resource\Native;

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
final class Boolean extends Object
{
    /**
     * {@inheritdoc}
     */
    public function coerce($value)
    {
        if ($value !== true and $value !== false) {
            $value = (boolean) $value;
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getClassName()
    {
        $label = $this->value ? "true" : "false";

        return parent::toString()->value()."(".$label.")";
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $label = $this->value ? "true" : "false";

        return parent::__toString()."(".$label.")";
    }
}
