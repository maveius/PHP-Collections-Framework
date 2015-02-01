<?php

namespace Mysidia\Resource\Test\Native;

use Mysidia\Resource\Native\Object;
use Mysidia\Resource\Test\Test;

class ConcreteObject extends Object
{
}

class ObjectTest extends Test
{
    /**
     * @test
     */
    public function it_can_be_cloned()
    {
        $object = new ConcreteObject();

        $clone = clone $object;

        $this->assertInstanceOf(get_class($object), $clone);
    }

    /**
     * @test
     */
    public function it_can_be_compared()
    {
        $firstObject = new ConcreteObject();

        $secondObject = new ConcreteObject();

        $this->assertTrue($firstObject->equals($secondObject));
    }

    /**
     * @test
     */
    public function it_returns_enhanced_class_name()
    {
        $object = new ConcreteObject();

        $this->assertInstanceOf("Mysidia\\Resource\\Native\\String", $object->getClassName());
    }

    /**
     * @test
     */
    public function it_returns_a_unique_hash_code()
    {
        $firstObject = new ConcreteObject();

        $firstHash = $firstObject->hashCode();

        $this->assertInternalType("float", $firstHash);

        $secondObject = new ConcreteObject();

        $secondHash = $secondObject->hashCode();

        $this->assertNotEquals($firstHash, $secondHash);
    }

    /**
     * @test
     */
    public function it_can_be_serialized_and_unserialized()
    {
        $object = new ConcreteObject();

        $serialized = serialize($object);

        $this->assertInternalType("string", $serialized);

        $unserialized = unserialize($serialized);

        $this->assertEquals($object, $unserialized);
    }

    /**
     * @test
     */
    public function it_can_be_cast_to_string()
    {
        $object = new ConcreteObject();

        $this->assertInternalType("string", (string) $object);
    }
}
