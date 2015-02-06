<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestEquals
{
    public function testEquals()
    {
        $this->assertTrue($this->firstObject->equals($this->firstObject));

        $this->assertFalse($this->firstObject->equals($this->secondObject));
    }
}