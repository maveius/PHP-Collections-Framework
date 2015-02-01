<?php

require __DIR__."/../vendor/autoload.php";

use Mysidia\Resource\Native\String;
use Mysidia\Resource\Collection\LinkedHashMap;

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

$map = new LinkedHashMap;
$map->put($mithosKey, $mithosValue);
$map->put($martelKey, $martelValue);
$map->put($yuanKey, $yuanValue);
$map->put($kratosKey, $kratosValue);
$map->put($remielKey, $remielValue);

$iterator = $map->iterator();
while($iterator->hasNext()){
    $entry = $iterator->nextEntry();
    echo "{$entry->getKey()}: {$entry->getValue()}<br>";
}

echo $map->get($mithosKey);
echo "<br>";
echo $map->get($martelKey);

/*
$map->clear();
var_dump($map);
var_dump($map->containsValue($remielKey));
var_dump($map->containsValue($remielValue));
*/
?>
