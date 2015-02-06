<?php

namespace Mysidia\Resource\Test\Native\Traits;

trait TestInvoke
{
    public function testInvoke()
    {
        $this->assertEquals($this->firstValue, call_user_func($this->firstObject));
    }
}