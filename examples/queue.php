<?php

require __DIR__."/../vendor/autoload.php";

use Mysidia\Resource\Collection\ArrayDeque;
use Mysidia\Resource\Collection\ArrayList;
use Mysidia\Resource\Collection\PriorityQueue;
use Mysidia\Resource\Native\Objective;
use Mysidia\Resource\Native\String;
use Mysidia\Resource\Utility\Comparative;

class StringComparator implements Comparative
{
    public function compare(Objective $object = null, Objective $object2 = null)
    {
        $length = ($object == null) ? 0 : $object->count();
        $length2 = ($object2 == null) ? 0 : $object2->count();
        $diff = $length - $length2;

        return $diff;
    }
}

$mithos = new String("Mithos Yggdrasill");
$martel = new String("Martel Yggdrasill");
$yuan = new String("Yuan Ka-fei");
$kratos = new String("Kratos Aurion");
$remiel = new String("Remiel");
$zelos = new String("Zelos");
$colette = new String("Colette");
$botta = new String("Botta");

$arraylist = new ArrayList(3);
$arraylist->add($mithos);
$arraylist->add($martel);
$arraylist->add($yuan);
$arraylist->add($kratos);
$arraylist->add($remiel);
$arraylist->add($zelos);
$arraylist->add($colette);
$arraylist->add($botta);
$queue = new PriorityQueue($arraylist);
//$queue = new PriorityQueue(4, new StringComparator);
//$queue = new PriorityQueue;
//$queue->offer($mithos);
//$queue->offer($martel);
//$queue->offer($yuan);
//$queue->offer($kratos);
//var_dump($queue);
//var_dump($queue->getArray());

echo "Elements inside PriorityQueue are<br>";
while ($queue->peek()) {
    echo $queue->poll();
    echo "<br>";
}

$deque = new ArrayDeque();
$deque->offerLast($mithos);
$deque->addLast($martel);
$deque->addLast($yuan);
$deque->offerLast($kratos);
$deque->addLast($remiel);

/*
var_dump($deque);
$deque->clear();
var_dump($deque->contains($mithos));
echo $deque->getFirst();
echo $deque->peekLast();
*/

$deque->remove($yuan);
$deque->offerLast($yuan);
echo "<br>Elements inside Deque are: <br>";
$iterator = $deque->iterator();
//$iterator = $deque->descendingIterator();
while ($iterator->hasNext()) {
    echo $iterator->next();
    echo "<br>";
}

/*
echo "<br>Now polling elements: <br>";
while(!$deque->isEmpty()){
    echo "Polling out {$deque->pollLast()}<br>";
    echo "Deque size shrinks to {$deque->size()}<br>";
}
echo "Deque is now empty!";
*/;
