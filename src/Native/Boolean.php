<?php

namespace Mysidia\Resource\Native;

/**
 * A boolean type wrapper
 *
 * @author Ordland
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
