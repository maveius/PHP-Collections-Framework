<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestToString
{
    public function testToString()
    {
        $this->assertInternalType("string", (string) $this->firstObject());
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
}
