<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestHash
{
    public function testHash()
    {
        $firstHash = $this->firstObject()->hash();

        $this->assertInternalType("string", $firstHash);

        $secondHash = $this->secondObject()->hash();

        $this->assertNotEquals($firstHash, $secondHash);
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
    abstract public function assertNotEquals($expected, $actual, $message = "", $delta = 0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false);
}
