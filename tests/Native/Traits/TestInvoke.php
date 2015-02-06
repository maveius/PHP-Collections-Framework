<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestInvoke
{
    public function testInvoke()
    {
        $this->assertEquals($this->firstValue(), call_user_func($this->firstObject()));
    }

    /**
     * @return mixed
     */
    abstract protected function firstValue();

    /**
     * @return mixed
     */
    abstract protected function firstObject();

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
