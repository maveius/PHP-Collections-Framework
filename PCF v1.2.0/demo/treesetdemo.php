<?php

require "autoloader.php";
use Resource\Native\String as String;
use Resource\Collection\TreeSet as TreeSet;

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