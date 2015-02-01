<?php

require __DIR__."/../vendor/autoload.php";

use Mysidia\Resource\Collection\Stack;
use Mysidia\Resource\Native\String;

$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdrasill");
$yuan = new String("Yuan Ka-fei");
$kratos = new String("Kratos Aurion");

$stack = new Stack();
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
