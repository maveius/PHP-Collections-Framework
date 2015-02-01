<?php

require __DIR__."/../vendor/autoload.php";

use Mysidia\Resource\Native\String;
use Mysidia\Resource\Collection\TreeSet;

$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdrasill");
$yuan = new String("Yuan Ka-fei");
$kratos = new String("Kratos Aurion");
$remiel = new String("Remiel");

$pronyma = new String("Pronyma");
$forcystus = new String("Forcystus");
$rodyle = new String("Rodyle");
$kvar = new String("Kvar");
$magnius = new String("Magnius");

$set = new TreeSet;
$set->add($mithos);
$set->add($martel);
$set->add($yuan);
$set->add($kratos);
$set->add($remiel);

$iterator = $set->iterator();
while($set->size() > 0){
    echo "{$set->pollFirst()}<br>";
    echo "Current Set Size is: {$set->size()}<br>";
}

//var_dump($set);

?>
