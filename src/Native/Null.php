<?php

namespace Mysidia\Resource\Native;

/**
 * A null type wrapper
 *
 * @author Ordland
 */
final class Null extends Object
{
    public function __construct()
    {
        $this->value = null;
    }
}
