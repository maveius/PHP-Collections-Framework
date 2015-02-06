<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestSerialize
{
    public function testSerialize()
    {
        $serialized = serialize($this->firstObject);

        $this->assertInternalType("string", $serialized);

        $unserialized = unserialize($serialized);

        $this->assertEquals($this->firstObject, $unserialized);
    }
}