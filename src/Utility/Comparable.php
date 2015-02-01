<?php

namespace Mysidia\Resource\Utility;
use Mysidia\Resource\Native\Objective;

/**
 * The Comparable Interface, it defines objects that can be compared with another.
 * It is a standard interface for objects that can be compared.
 * @category Resource
 * @package Utility
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */
 
interface Comparable{

	/**
     * The compareTo method, compares this object with another.
	 * @param Objective  $object
     * @access public
     * @return Int
     */
    public function compareTo(Objective $object);

}
?>
