<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestEquals
{
    public function testEquals()
    {
        $this->assertTrue($this->firstObject()->equals($this->firstObject()));

        $this->assertFalse($this->firstObject()->equals($this->secondObject()));
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
     * @param bool   $condition
     * @param string $message
     */
    abstract public function assertTrue($condition, $message = "");

    /**
     * @param bool   $condition
     * @param string $message
     */
    abstract public function assertFalse($condition, $message = "");
}
