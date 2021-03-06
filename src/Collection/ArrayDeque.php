<?php

namespace Mysidia\Resource\Collection;

use Mysidia\Resource\Exception\IllegalArgumentException;
use Mysidia\Resource\Exception\IllegalStateException;
use Mysidia\Resource\Exception\NosuchElementException;
use Mysidia\Resource\Native\Arrays;
use Mysidia\Resource\Native\Objective;

/**
 * The ArrayDeque Class, extending from abstract Collection class.
 * It defines a standard class to handle array deque type collections, similar to Java's ArrayDeque.
 * @category  Resource
 * @package   Collection
 * @author    Ordland
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 *
 */
class ArrayDeque extends Collection implements Dequeable
{
    /**
     * serialID constant, it serves as identifier of the object being PriorityQueue.
     */
    const SERIALID = "2340985798034038923L";

    /**
     * The array property, it stores the data passed to this ArrayDeque.
     * @access private
     * @var Arrays
     */
    private $array;

    /**
     * The size property, it stores the current size of the ArrayDeque.
     * @access private
     * @var Int
     */
    private $size;

    /**
     * The head property, it defines the index of the element at the head of ArrayDeque.
     * @access private
     * @var Int
     */
    private $head = 0;

    /**
     * The tail property, it defines the index of the element at the tail of ArrayDeque.
     * @access private
     * @var Int
     */
    private $tail = 0;

    /**
     * Constructor of ArrayDeque Class, it initializes the ArrayDeque given its size or another Collection Object.
     *
     * @param Int|Collective $param
     *
     * @access public
     * @return Void
     */
    public function __construct($param = 16)
    {
        parent::__construct();
        if (is_int($param)) {
            $this->allocateElements($param);
        } elseif ($param instanceof Collective) {
            $this->allocateElements($param->size());
            $this->addAll($param);
        } else {
            throw new IllegalArgumentException();
        }
    }

    /**
     * The add method, append an object to the tail of the ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function add(Objective $object)
    {
        $this->addLast($object);

        return true;
    }

    /**
     * The addFirst method, inserts an object at the head of the ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Void
     */
    public function addFirst(Objective $object)
    {
        $this->head = ($this->head - 1) & ($this->array->length() - 1);
        $this->array[$this->head] = $object;
        if ($this->head == $this->tail) {
            $this->doubleCapacity();
        }
    }

    /**
     * The addLast method, inserts an object at the tail of the ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Void
     */
    public function addLast(Objective $object)
    {
        $this->array[$this->tail] = $object;
        $tail = ($this->tail = $this->tail + 1) & ($this->array->length() - 1);
        if ($this->head == $tail) {
            $this->doubleCapacity();
        }
    }

    /**
     * The allocateElements method, allocate empty Array to hold the given number of elements.
     *
     * @param Int $size
     *
     * @access private
     * @return Void
     */
    private function allocateElements($capacity)
    {
        $initialCapacity = 8;
        if ($initialCapacity < $capacity) {
            $initialCapacity = $capacity;
            if ($initialCapacity < 0) {
                $initialCapacity = 1;
            }
        }
        $this->array = new Arrays($initialCapacity);
    }

    /**
     * The checkInvariant method, checkes the invariant on the ArrayDeque.
     * @access private
     * @return Void
     */
    private function checkInvariant()
    {
        assert($this->array[$this->tail] == null);
        assert(($this->head == $this->tail) ?
            $this->array[$this->head] == null :
            ($this->array[$this->head] != null and $this->array[($this->tail - 1) & ($this->array->length() - 1)] != null));
        assert($this->array[($this->head - 1) & ($this->array->length() - 1)] == null);
    }

    /**
     * The clear method, drops all objects currently stored in this ArrayDeque.
     * @access public
     * @return Void
     */
    public function clear()
    {
        $head = $this->head;
        $tail = $this->tail;
        if ($head != $tail) { // clear all cells
            $this->head = $this->tail = 0;
            $index = $head;
            $max = $this->array->length() - 1;
            do {
                $this->array[$index] = null;
                $index = ($index + 1) & $max;
            } while ($index != $tail);
        }
    }

    /**
     * The contains method, checks if a given object is already on the ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function contains(Objective $object)
    {
        if ($object == null) {
            return false;
        }
        $max = $this->array->length() - 1;
        $head = $this->head;
        while (($element = $this->array[$head]) != null) {
            if ($object->equals($element)) {
                return true;
            }
            $head = ($head + 1) & $max;
        }

        return false;
    }

    /**
     * The delete method, removes an object from the specific index on the ArrayDeque.
     * @access public
     * @return Boolean
     */
    public function delete($index)
    {
        $this->checkInvariant();
        $max = $this->array->length() - 1;
        $head = $this->head;
        $tail = $this->tail;
        $front = ($index - $head) & $max;
        $back = ($tail - $index) & $max;
        if ($front >= (($tail - $head) & $max)) {
            throw new IllegalStateException();
        }
        $this->array[$index] = null;

        if ($front < $back) {
            $end = ($head < $tail) ? $head : $tail;
            for ($i = $index; $i > $end; $i--) {
                $this->array[$i] = $this->array[$i - 1];
            }
            $this->head = ($head + 1) & $max;

            return false;
        } else {
            $end = ($head > $tail) ? $head : $tail;
            for ($i = $index; $i < $end; $i++) {
                $this->array[$i] = $this->array[$i + 1];
            }
            $this->tail = ($tail - 1) & $max;

            return true;
        }
    }

    /**
     * The descendingIterator method, acquires an instance of DescendingIterator object of this ArrayDeque.
     * This method returns an iterator with objects in reverse order as the ArrayDeque.
     * @access public
     * @return DescendingQueueIterator
     */
    public function descendingIterator()
    {
        return new DescendingQueueIterator($this);
    }

    /**
     * The doubleCapacity method, double the capacity of the internal array inside this ArrayDeque.
     * @access private
     * @return Void
     */
    private function doubleCapacity()
    {
        assert($this->head == $this->tail);
        $position = $this->head;
        $total = $this->array->length();
        $right = $total - $position;
        $newCapacity = $total << 1;
        if ($newCapacity < 0) {
            throw new IllegalStateException("Sorry, Deque is way too big.");
        }
        $this->array->setSize($newCapacity);
        $this->head = 0;
        $this->tail = $total;
    }

    /**
     * The element method, retrieves but not remove the head of the ArrayDeque.
     * This method throws an Exception if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function element()
    {
        return $this->getFirst();
    }

    /**
     * The erase method, removes and retrieves the object at the head of this ArrayDeque.
     * @access public
     * @return Objective
     */
    public function erase()
    {
        return $this->eraseFirst();
    }

    /**
     * The eraseFirst method, removes and retrieves the object at the head of this ArrayDeque.
     * The method throws an Exception if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function eraseFirst()
    {
        $object = $this->pollFirst();
        if ($object == null) {
            throw new NosuchElementException();
        }

        return $object;
    }

    /**
     * The eraseLast method, removes and retrieves the object at the tail of this ArrayDeque.
     * The method throws an Exception if the LinkedList is empty.
     * @access public
     * @return Objective
     */
    public function eraseLast()
    {
        $object = $this->pollLast();
        if ($object == null) {
            throw new NosuchElementException();
        }

        return $object;
    }

    /**
     * The getArray method, retrieves an instance of the array object that contains data inside this ArrayDeque.
     * @access public
     * @return Arrays
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * The getFirst method, retrieves but not remove the object at the head of this ArrayDeque.
     * The method throws an Exception if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function getFirst()
    {
        $object = $this->array[$this->head];
        if ($object == null) {
            throw new NosuchElementException();
        }

        return $object;
    }

    /**
     * The getHead method, returns the head index of the ArrayDeque.
     * @access public
     * @return Int
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * The getLast method, retrieves but not remove the object at the tail of this ArrayDeque.
     * The method throws an Exception if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function getLast()
    {
        $tail = ($this->tail - 1) & ($this->array->length() - 1);
        $object = $this->array[$tail];
        if ($object == null) {
            throw new NosuchElementException();
        }

        return $object;
    }

    /**
     * The getTail method, returns the tail index of the ArrayDeque.
     * @access public
     * @return Int
     */
    public function getTail()
    {
        return $this->tail;
    }

    /**
     * The isEmpty method, checks if the ArrayDeque is empty or not.
     * @access public
     * @return Boolean
     */
    public function isEmpty()
    {
        return ($this->head == $this->tail);
    }

    /**
     * The iterator method, acquires an instance of the DequeIterator object of this ArrayDeque.
     * @access public
     * @return DequeIterator
     */
    public function iterator()
    {
        return new DequeIterator($this);
    }

    /**
     * The offer method, inserts a specific Object to the tail of this ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function offer(Objective $object)
    {
        return $this->offerLast($object);
    }

    /**
     * The offerFirst method, inserts an object at the head of this ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function offerFirst(Objective $object)
    {
        $this->addFirst($object);

        return true;
    }

    /**
     * The offerFirst method, inserts an object at the tail of this ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function offerLast(Objective $object)
    {
        $this->addLast($object);

        return true;
    }

    /**
     * The peek method, retrieves but not remove the object at the head of this ArrayDeque.
     * This method returns NULL if ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function peek()
    {
        return $this->peekFirst();
    }

    /**
     * The peekFirst method, retrieves but not remove the object at the head of this ArrayDeque.
     * This method returns NULL if ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function peekFirst()
    {
        return $this->array[$this->head];
    }

    /**
     * The peekLast method, retrieves but not remove the object at the tail of this ArrayDeque.
     * This method returns NULL if ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function peekLast()
    {
        $tail = ($this->tail - 1) & ($this->array->length() - 1);

        return $this->array[$tail];
    }

    /**
     * The poll method, retrieves and removes the object at the head of this ArrayDeque at the same time.
     * @access public
     * @return Objective
     */
    public function poll()
    {
        return $this->pollFirst();
    }

    /**
     * The pollFirst method, retrieves and removes the object at the head of this ArrayDeque at the same time.
     * The method returns NULL if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function pollFirst()
    {
        $head = $this->head;
        $object = $this->array[$head];
        if ($object == null) {
            return;
        }
        $this->array[$head] = null;
        $this->head = ($head + 1) & ($this->array->length() - 1);

        return $object;
    }

    /**
     * The pollLast method, retrieves and removes the object at the tail of this ArrayDeque at the same time.
     * The method returns NULL if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function pollLast()
    {
        $tail = ($this->tail - 1) & ($this->array->length() - 1);
        $object = $this->array[$tail];
        if ($object == null) {
            return;
        }
        $this->array[$tail] = null;
        $this->tail = $tail;

        return $object;
    }

    /**
     * The pop method, pops an object from the stack represented by this ArrayDeque.
     * The method throws an Exception if if the LinkedList is empty.
     * @access public
     * @return Objective
     */
    public function pop()
    {
        return $this->eraseFirst();
    }

    /**
     * The push method, pushes an object onto the stack represented by this ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Objective
     */
    public function push(Objective $object)
    {
        $this->addFirst();
    }

    /**
     * The remove method, removes a supplied Object from this ArrayDeque.
     *
     * @param Objective $object
     *
     * @access public
     * @return Boolean
     */
    public function remove(Objective $object = null)
    {
        $this->removeFirst($object);
    }

    /**
     * The removeFirst method, removes and retrieves the first occurrence of a given object at this ArrayDeque.
     * The method throws an Exception if the ArrayDeque is empty.
     * @access public
     * @return Objective
     */
    public function removeFirst(Objective $object = null)
    {
        if ($object == null) {
            return false;
        }
        $max = $this->array->length() - 1;
        $head = $this->head;
        while (($element = $this->array[$head]) != null) {
            if ($object->equals($element)) {
                $this->delete($head);

                return true;
            }
            $head = ($head + 1) & $max;
        }

        return false;
    }

    /**
     * The removeLast method, removes and retrieves the last occurrence of a given object at this ArrayDeque.
     * The method throws an Exception if the ArrayDeque is empty.
     * @access public
     * @return Void
     */
    public function removeLast(Objective $object = null)
    {
        if ($object == null) {
            return false;
        }
        $max = $this->array->length() - 1;
        $head = ($this->tail - 1) & $max;
        while (($element = $this->array[$head]) != null) {
            if ($object->equals($element)) {
                $this->delete($head);

                return true;
            }
            $head = ($head - 1) & $max;
        }

        return false;
    }

    /**
     * The size method, returns the current size of this ArrayDeque.
     * @access public
     * @return Int
     */
    public function size()
    {
        $size = ($this->tail - $this->head) & ($this->array->length() - 1);

        return $size;
    }

    /**
     * The toArray method, acquires the data stored in ArrayDeque in Array format.
     * @access public
     * @return Array
     */
    public function toArray()
    {
        $array = $this->getArray();

        return $array->toArray();
    }
}
