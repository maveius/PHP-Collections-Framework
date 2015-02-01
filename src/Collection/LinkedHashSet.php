<?php

namespace Mysidia\Resource\Collection;

/**
 * The LinkedHashSet Class, extending from the HashSet Class.
 * It defines a standard Set class with its elements ordered in their insertion order.
 * @category Resource
 * @package Collection
 * @author Ordland 
 * @copyright Mysidia RPG, Inc
 * @link http://www.mysidiarpg.com 
 *
 */

class LinkedHashSet extends HashSet{

	/**
	 * serialID constant, it serves as identifier of the object being LinkedHashSet.
     */
    const SERIALID = "-2851667679971038690L";
		
	/**
     * Constructor of LinkedHashSet Class, it initializes the LinkedHashSet given its capacity or another Collection Object.    
     * @param Int|Collective  $param
	 * @param Float  $loadFactor
     * @access public
     * @return Void
     */	
	public function __construct($param = HashMap::DEFAULTCAPACITY, $loadFactor = HashMap::DEFAULTLOAD){
	    parent::__construct($param, $loadFactor, TRUE);
		if($param instanceof Collective) $this->addAll($param);
	}	
}
?>
