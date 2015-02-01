<?php

require "autoloader.php";
use Mysidia\Resource\Native\String;
use Mysidia\Resource\Collection\HashSet;
use Mysidia\Resource\Collection\LinkedHashSet;

$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdrasill");
$yuan = new String("Yuan Ka-fei");
$kratos = new String("Kratos Aurion");
$yggdrasill = new String("Mithos Yggdrasill");

$set = new HashSet;
$set->add($mithos);
$set->add($martel);
$set->add($yuan);
$set->add($kratos);
//$set->add(2);

$iterator = $set->iterator();
echo "HashSet Test<br>";
while($iterator->hasNext()){
    echo $iterator->next();
    echo "<br>";
}
echo "<br>";
//var_dump($set);

$set2 = new LinkedHashSet;
$set2->add($mithos);
$set2->add($martel);
$set2->add($yuan);
$set2->add($kratos);

$iterator2 = $set2->iterator();
echo "LinkedHashSet Test<br>";
while($iterator2->hasNext()){
    echo $iterator2->next();
    echo "<br>";
}
echo "<br>";
//var_dump($set2);
?>
