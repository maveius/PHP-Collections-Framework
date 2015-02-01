<?php

require "autoloader.php";
use Resource\Native\String as String;
use Resource\Collection\ArrayList as ArrayList;
use Resource\Collection\LinkedList as LinkedList;

$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdrasill");
$yuan = new String("Yuan Ka-Fei");
$kratos = new String("Kratos Aurion");
$remiel = new String("Remiel");

$arrayList = new ArrayList(5);
$arrayList->add(new String("Pronyma"));
$arrayList->add(new String("Forcystus"));
$arrayList->add(new String("Rodyle"));
$arrayList->add(new String("Kvar"));
$arrayList->add(new String("Magnius"));

$linkedList = new LinkedList;
$linkedList->offerFirst($mithos);
$linkedList->offerLast($martel);
$linkedList->offerLast($yuan);
$linkedList->offerLast($kratos);

$iterator = $linkedList->iterator();
$iterator->add($martel);

while($iterator->hasNext()){
    echo $iterator->next();
    echo "<br>";
}

//echo $linkedList->indexOf($mithos);
//echo $linkedList->indexOf($yuan);     
?>