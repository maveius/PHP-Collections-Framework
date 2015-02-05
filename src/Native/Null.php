<?php

namespace Mysidia\Resource\Native;

/**
 * The Null Class, extending from root Object Class.
 *
 * It defines a Null Object that does not do anything but to serve as
 * placeholder or NulL Values.
 *
 * @category  Resource
 * @package   Native
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @final
 */
final class Null extends Object
{
    public function __construct()
    {
        $this->value = null;
    }
}
