<?php

namespace Mysidia\Resource\Test\Native;

use Exception;
use Mockery;
use Mysidia\Resource\Native\Arrays;
use Mysidia\Resource\Native\Objective;
use Mysidia\Resource\Test\Test;

class ConcreteObjective implements Objective
{
    public function serialize()
    {
        // stub method
    }

    public function unserialize($serialized)
    {
        // stub method
    }

    public function equals(Objective $object)
    {
        // stub method
    }

    public function getClassName()
    {
        // stub method
    }

    public function __clone()
    {
        // stub method
    }

    public function __toString()
    {
        // stub method

        return "";
}}

class ArraysTest extends Test
{
    /**
     * @test
     */
    public function it_can_be_cloned()
    {
        $arrays = new Arrays();

        $clone = clone $arrays;

        $this->assertInstanceOf(get_class($arrays), $clone);
    }

    /**
     * @test
     *
     * @expectedException Exception
     */
    public function it_throws_for_invalid_arguments()
    {
        $arrays = new Arrays();

        $objective = new ConcreteObjective();

        $this->assertTrue($arrays->equals($objective));
    }

    /**
     * @test
     */
    public function it_can_be_compared()
    {
        $firstArrays = new Arrays();

        $secondArrays = new Arrays();

        $this->assertTrue($firstArrays->equals($secondArrays));
    }

    /**
     * @test
     */
    public function it_can_return_length()
    {
        $arrays = new Arrays(3);

        $this->assertEquals(3, $arrays->length());
    }

    /**
     * @test
     */
    public function it_acn_return_an_iterator()
    {
        $arrays = new Arrays();

        $this->assertInstanceOf("Iterator", $arrays->iterator());
    }

    /**
     * @test
     */
    public function it_returns_enhanced_class_name()
    {
        $arrays = new Arrays();

        $this->assertInstanceOf("Mysidia\\Resource\\Native\\String", $arrays->getClassName());
    }

    /**
     * @test
     */
    public function it_can_be_serialized_and_unserialized()
    {
        $arrays = new Arrays();

        $serialized = serialize($arrays);

        $this->assertInternalType("string", $serialized);

        $unserialized = unserialize($serialized);

        $this->assertEquals($arrays, $unserialized);
    }

    /**
     * @test
     */
    public function it_can_be_cast_to_string()
    {
        $arrays = new Arrays();

        $this->assertInternalType("string", (string) $arrays);
    }
}
