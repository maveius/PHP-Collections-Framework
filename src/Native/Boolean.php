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
        if (!is_bool($value)) {
            $value = (boolean) $value;
        }

        return $value;
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
