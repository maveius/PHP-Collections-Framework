<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestSerialize
{
    public function testSerialize()
    {
        $serialized = serialize($this->firstObject());

        $this->assertInternalType("string", $serialized);

        $unserialized = unserialize($serialized);

        $this->assertEquals($this->firstObject(), $unserialized);
    }

    /**
     * @return mixed
     */
    abstract protected function firstObject();

    /**
     * @param string $expected
     * @param mixed  $actual
     * @param string $message
     */
    abstract public function assertInternalType($expected, $actual, $message = "");

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
