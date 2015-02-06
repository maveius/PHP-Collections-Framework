<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestClone
{
    public function testClone()
    {
        $clone = clone $this->firstObject();

        $this->assertInstanceOf(get_class($this->firstObject()), $clone);

        $this->assertNotSame($this->firstObject(), $clone);
    }

    /**
     * @return mixed
     */
    abstract public function firstObject();

    /**
     * @param string $expected
     * @param mixed  $actual
     * @param string $message
     */
    abstract public function assertInstanceOf($expected, $actual, $message = "");

    /**
     * @param mixed  $expected
     * @param mixed  $actual
     * @param string $message
     */
    abstract public function assertNotSame($expected, $actual, $message = "");
}
