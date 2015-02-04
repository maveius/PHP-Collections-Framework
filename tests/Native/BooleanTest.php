<?php

namespace Mysidia\Resource\Test\Native;

use Mysidia\Resource\Native\Boolean;
use Mysidia\Resource\Test\Test;

class BooleanTest extends Test
{
    /**
     * @test
     */
    public function it_coerces_constructor_values()
    {
        $values = [
            true,
            1,
            "anything",
        ];

        foreach ($values as $value) {
            $boolean = new Boolean($value);

            $this->assertTrue($boolean->getValue());

            $boolean = null;
        }

        $values = [
            false,
            0,
            "",
        ];

        foreach ($values as $value) {
            $boolean = new Boolean($value);

            $this->assertFalse($boolean->getValue());

            $boolean = null;
        }
    }
}
