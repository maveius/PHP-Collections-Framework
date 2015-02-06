<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestToString
{
    public function testToString()
    {
        $this->assertInternalType("string", (string) $this->firstObject);
    }
}