<?php

require "autoloader.php";
use Mysidia\Resource\Native\String;
use Mysidia\Resource\Collection\HashMap;

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

$map = new HashMap;
$map->put($mithosKey, $mithosValue);
$map->put($martelKey, $martelValue);
$map->put($yuanKey, $yuanValue);
$map->put($kratosKey, $kratosValue);

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

/*
$map2 = new HashMap($map);
var_dump($map2);
var_dump($map2->equals($map));
*/

$map2 = new HashMap;
$map2->put($pronymaKey, $pronymaValue);
$map2->put($forcystusKey, $forcystusValue);
$map2->put($rodyleKey, $rodyleValue);
$map2->put($kvarKey, $kvarValue);
$map2->put($magniusKey, $magniusValue);
$map2->putAll($map);
//var_dump($map2);

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

$iterator = $map2->iterator();
while($iterator->hasNext()){
    $entry = $iterator->nextEntry();
    echo "{$entry->getKey()}: {$entry->getValue()}<br>";
}

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
