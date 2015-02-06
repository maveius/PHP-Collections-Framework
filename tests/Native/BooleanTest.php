<?php

namespace Mysidia\Resource\Test\Native;

use Mysidia\Resource\Native\Boolean;
use Mysidia\Resource\Test\Test;

class BooleanTest extends Test
{
    /**
     * @test
     */
    public function testCoerce()
    {
        foreach ([true, 1, "anything"] as $value) {
            $boolean = new Boolean($value);

            $this->assertTrue($boolean->value());
        }

        foreach ([false, 0, ""] as $value) {
            $boolean = new Boolean($value);

            $this->assertFalse($boolean->value());
        }
    }

    public function testToString()
    {
        $firstObject = new Boolean(true);

        $this->assertEquals("Mysidia\\Resource\\Native\\Boolean(true)", (string) $firstObject);

        $secondObject = new Boolean(false);

        $this->assertEquals("Mysidia\\Resource\\Native\\Boolean(false)", (string) $secondObject);
    }
}
