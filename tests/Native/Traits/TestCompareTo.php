<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestCompareTo
{
    public function testCompareTo()
    {
        $this->assertEquals(-1, $this->firstObject()->compareTo($this->secondObject()));
    }

    /**
     * @return mixed
     */
    abstract protected function firstObject();

    /**
     * @return mixed
     */
    abstract protected function secondObject();

    /**
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     * @param int    $delta
     * @param int    $maxDepth
     * @param bool   $canonicalize
     * @param bool   $ignoreCase
     */
    abstract public function assertEquals($expected, $actual, $message = "", $delta = 0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false);
}
