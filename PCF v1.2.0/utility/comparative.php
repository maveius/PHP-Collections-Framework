<?php

namespace Mysidia\Resource\Utility;
use Mysidia\Resource\Native\Objective;

/**
 * The Comparative Interface, it defines special objects that can compare two other objects.
 * It basically serves as an interface for utility classes that can handle complex comparison algorithm.
 * @category Resource
 * @package Utility
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */
 
interface Comparative{

    /**
     * The compare method, compares two objects with each other with its internal algorithm.
     * @param Objective  $object
     * @param Objective  $object2	 
     * @access public
     * @return Int
     */
    public function compare(Objective $object, Objective $object2);

}
?>
