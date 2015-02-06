<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestCompareTo
{
    public function testCompareTo()
    {
        $this->assertEquals(-1, $this->firstObject->compareTo($this->secondObject));
    }
}