<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestHash
{
    public function testHash()
    {
        $firstHash = $this->firstObject->hash();

        $this->assertInternalType("string", $firstHash);

        $secondHash = $this->secondObject->hash();

        $this->assertNotEquals($firstHash, $secondHash);
    }
}