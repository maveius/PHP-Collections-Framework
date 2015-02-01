<?php

require __DIR__."/../vendor/autoload.php";

use Mysidia\Resource\Collection\ArrayList;
use Mysidia\Resource\Native\String;

$seraphim = new ArrayList(4);
$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdraill");
$yuan = new String("Yuan Kafei");
$kratos = new String("Kratos Aurion");

$seraphim->add($martel);
$seraphim->add($yuan);
$seraphim->add($kratos);
$seraphim->insert(0, $mithos);
$seraphIterator = $seraphim->iterator();

echo "Cruxis has the following Four Seraphim:<br>";
while ($seraphIterator->hasNext()) {
    echo $seraphIterator->next();
    echo "<br>";
}

$desians = new ArrayList(5);
$pronyma = new String("Pronyma");
$forcystus = new String("Forcystus");
$rodyle = new String("Rodyle");
$kvar = new String("Kvar");
$magnius = new String("Magnius");

$desians->add($pronyma);
$desians->add($forcystus);
$desians->add($rodyle);
$desians->add($kvar);
$desians->add($magnius);
$desianIterator = $desians->iterator();

echo "<br>Cruxis has the following Five Grand Cardinals:<br>";
while ($desianIterator->hasNext()) {
    echo $desianIterator->next();
    echo "<br>";
}

$desianIterator->rewind();
echo "The leader of the desian grand cardinals is: ";
echo $desianIterator->next();
echo "<br>";

$cruxis = new ArrayList($desians);
$cruxis->insertAll(0, $seraphim);
$remiel = new String("Remiel");
$cruxis->add($remiel);
$cruxisIterator = $cruxis->iterator();
echo "<br>The following members all belong to cruxis: <br>";
while ($cruxisIterator->hasNext()) {
    echo $cruxisIterator->next();
    echo "<br>";
}

$deceaced = new ArrayList();
$deceaced->add($magnius);
$deceaced->add($kvar);
$deceaced->add($remiel);
$deceaced->add($martel);
$deceacedIterator = $deceaced->iterator();
echo "<br>The following {$deceaced->size()} members are already dead before we visit Tethe'alla: <br>";
while ($deceacedIterator->hasNext()) {
    echo $deceacedIterator->next();
    echo "<br>";
}

$cruxis->removeAll($deceaced);
$aliveIterator = $cruxis->iterator();
echo "<br>As a result, only the following Cruxis Members are still alive: <br>";
while ($aliveIterator->hasNext()) {
    echo $aliveIterator->next();
    echo "<br>";
}

$cruxis->retainAll($desians);
$aliveIterator = $cruxis->iterator();
echo "<br>The Desian Grand Cardinals still alive are: <br>";
while ($aliveIterator->hasNext()) {
    echo $aliveIterator->next();
    echo "<br>";
}

//$cruxis->trimSize();
//var_dump($cruxis);
//var_dump($cruxis->get(1));
;
