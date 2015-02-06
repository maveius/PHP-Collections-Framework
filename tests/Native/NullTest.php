<?php

namespace Mysidia\Resource\Test\Native;

use Mysidia\Resource\Native\Null;
use Mysidia\Resource\Test\Test;

class NullTest extends Test
{
    /**
     * @test
     */
    public function it_returns_a_value()
    {
        $null = new Null();

        $this->assertNull($null->value());
    }
}
