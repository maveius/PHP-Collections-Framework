<?php

require "autoloader.php";
use Mysidia\Resource\Native\String;
use Mysidia\Resource\Collection\Stack;

$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdrasill");
$yuan = new String("Yuan Ka-fei");
$kratos = new String("Kratos Aurion");

$stack = new Stack;
$stack->push($mithos);
$stack->push($martel);
$stack->push($yuan);
$stack->push($kratos);    

echo $stack->peek();
echo "<br>";
echo $stack->pop();
echo "<br>";
echo $stack->peek();
echo "<br>";
echo $stack->pop();
echo "<br>";
echo $stack->peek();
echo "<br>";
echo $stack->pop();
echo "<br>";

?>
