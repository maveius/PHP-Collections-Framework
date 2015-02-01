<?php

require "autoloader.php";
use Resource\Native\String as String;
use Resource\Collection\HashMap as HashMap;
use Resource\Collection\TreeMap as TreeMap;

$mithosKey = new String("Mithos Yggdrasill");
$martelKey = new String("Martel Yggdrasill");
$yuanKey = new String("Yuan Ka-fei");
$kratosKey = new String("Kratos Aurion");
$remielKey = new String("Remiel");

$mithosValue = new String("Leader of Cruxis");
$martelValue = new String("Mithos' Older Sister");
$yuanValue = new String("Leader of Renegades");
$kratosValue = new String("One of Four Seraphim");
$remielValue = new String("Minion of Cruxis");

/*
echo $mithosKey->hashCode();
echo "<br>";
echo $martelKey->hashCode();
echo "<br>";
echo $yuanKey->hashCode();
echo "<br>";
echo $kratosKey->hashCode();
echo "<br>";
echo $mithosValue->hashCode();
echo "<br>";
echo $martelValue->hashCode();
echo "<br>";
echo $yuanValue->hashCode();
echo "<br>";
echo $kratosValue->hashCode();
echo "<br>";
*/

$pronymaKey = new String("Pronyma");
$forcystusKey = new String("Forcystus");
$rodyleKey = new String("Rodyle");
$kvarKey = new String("Kvar");
$magniusKey = new String("Magnius");

$pronymaValue = new String("Twilight Pronyma");
$forcystusValue = new String("Forcystus the Gnashing Gale");
$rodyleValue = new String("Iron Will Rodyle");
$kvarValue = new String("Kvar the Fury Tempest ");
$magniusValue = new String("Magnius the Pyrcoclasm");

$map = new HashMap;
$map->put($mithosKey, $mithosValue);
$map->put($martelKey, $martelValue);
$map->put($yuanKey, $yuanValue);
$map->put($kratosKey, $kratosValue);
$map->put($remielKey, $remielValue);

/*
$entries = new Arrays(9);
$entries[0] = $map->getEntry($mithosKey);
$entries[1] = $map->getEntry($martelKey);
$entries[2] = $map->getEntry($yuanKey);
$entries[3] = $map->getEntry($kratosKey);
$entries[4] = $map->getEntry($pronymaKey);
$entries[5] = $map->getEntry($forcystusKey);
$entries[6] = $map->getEntry($rodyleKey);
$entries[7] = $map->getEntry($kvarKey);
$entries[8] = $map->getEntry($magniusKey);

foreach($entries as $entry){
    echo "Entry: {$entry->getKey()}";
    echo "<br>";
    echo "Left: ";
    $left = ($entry->getLeft() == NULL)?NULL:$entry->getLeft();
    echo $left;
    echo "<br>";
    echo "Right: ";
    $right = ($entry->getRight() == NULL)?NULL:$entry->getRight();
    echo $right;
    echo "<br>";
    echo "Parent: ";
    $parent = ($entry->getParent() == NULL)?NULL:$entry->getParent();
    echo $parent;
    echo "<br>";  
    echo "<br>";       
}
*/

//echo $map->getFirstEntry()->getKey();
$map2 = new TreeMap($map); 
$map2->put($pronymaKey, $pronymaValue);
$map2->put($forcystusKey, $forcystusValue);
$map2->put($rodyleKey, $rodyleValue);
$map2->put($kvarKey, $kvarValue);
$map2->put($magniusKey, $magniusValue);

/*
$submap = $map2->subMap($martelKey, $remielKey);
$iterator = $submap->iterator();
*/

//$descMap = $map2->descendingMap();
$iterator = $map2->iterator();
while($iterator->hasNext()){
    $entry = $iterator->next();
    //echo "{$entry}<br>";
    echo "{$entry->getKey()}: {$entry->getValue()}<br>";
}

/*
$map2 = new HashMap($map);
var_dump($map2);
var_dump($map2->equals($map));
*/

/*
$map2 = new HashMap;
$map2->put($pronymaKey, $pronymaValue);
$map2->put($forcystusKey, $forcystusValue);
$map2->put($rodyleKey, $rodyleValue);
$map2->put($kvarKey, $kvarValue);
$map2->put($magniusKey, $magniusValue);
$map2->putAll($map);
//var_dump($map2);
*/

/*
echo $map->get($mithosKey);
echo $map->get($martelKey);
echo $map->get($yuanKey);
echo $map->get($kratosKey);
echo $map->get($remielKey);
*/

/*
var_dump($map->containsKey($mithosKey));
var_dump($map->containsKey($martelKey));
var_dump($map->containsKey($remielKey));
var_dump($map->containsValue($yuanValue));
var_dump($map->containsValue($kratosValue));
var_dump($map->containsValue($remielValue));
*/

//$map->remove($martelKey);
//$map->remove($yuanKey);

/*
$keyIterator = $map->keyIterator();
while($keyIterator->hasNext()){
    $key = $keyIterator->next();
    echo "{$key}<br>";
}
*/

/*
$valueIterator = $map->valueIterator();
while($valueIterator->hasNext()){
    $value = $valueIterator->next();
    echo "{$value}<br>";
}
*/

/*
$iterator = $map->iterator();
while($iterator->hasNext()){
    $entry = $iterator->nextEntry();
    echo "{$entry->getKey()}: {$entry->getValue()}<br>";
}
*/

/*
$iterator = $map2->iterator();
while($iterator->hasNext()){
    $entry = $iterator->nextEntry();
    echo "{$entry->getKey()}: {$entry->getValue()}<br>";
}
*/

/*
$entry = $map->getEntry($yuanKey);
$map->removeMapping($entry);
var_dump($entry);
echo $map2->size();
$map2->clear();
*/

//var_dump($map);
//var_dump($map->keySet());
//var_dump($map->valueSet());
//var_dump($map->entrySet());
//var_dump($iterator);
//var_dump($map2)
?>