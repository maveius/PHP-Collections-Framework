<?php

namespace Mysidia\Resource\Test\Native;

use InvalidArgumentException;
use Mockery;
use Mysidia\Resource\Native\Arrays;
use Mysidia\Resource\Test\Test;
use Mysidia\Resource\Valuable;

class ArraysTest extends Test
{
    use Traits\TestClone;
    use Traits\TestCompareTo;
    use Traits\TestEquals;
    use Traits\TestHash;
    use Traits\TestInvoke;
    use Traits\TestSerialize;
    use Traits\TestToString;

    /**
     * @var int
     */
    protected $firstLength;

    /**
     * @var array
     */
    protected $firstValue;

    /**
     * @var Arrays
     */
    protected $firstObject;

    /**
     * @var int
     */
    protected $secondLength;

    /**
     * @var array
     */
    protected $secondValue;

    /**
     * @var Arrays
     */
    protected $secondObject;

    protected function setUp()
    {
        parent::setUp();

        $this->firstLength = 1;

        $this->firstValue = ["foo"];

        $this->firstObject = new Arrays($this->firstLength);

        $this->firstObject[0] = $this->firstValue[0];

        $this->secondLength = 2;

        $this->secondValue = ["bar", "baz"];

        $this->secondObject = new Arrays($this->secondLength);

        $this->secondObject[0] = $this->secondValue[0];
        $this->secondObject[1] = $this->secondValue[1];
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsForInvalidArgumentsOnEquals()
    {
        $mock = Mockery::mock("stdClass");

        $this->firstObject->equals($mock);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsForInvalidArgumentsOnCompareTo()
    {
        /**
         * @var $mock Valuable
         */
        $mock = Mockery::mock("Mysidia\\Resource\\Valuable");

        $this->firstObject->compareTo($mock);
    }

    public function testLength()
    {
        $this->assertEquals($this->firstLength, $this->firstObject->length());
    }

    public function testIterator()
    {
        $this->assertInstanceOf("Iterator", $this->firstObject->iterator());
    }
}
