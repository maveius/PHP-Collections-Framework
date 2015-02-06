<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestClone
{
    public function testClone()
    {
        $clone = clone $this->firstObject;

        $this->assertInstanceOf(get_class($this->firstObject), $clone);

        $this->assertNotSame($this->firstObject, $clone);
    }
}