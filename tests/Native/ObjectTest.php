<?php

namespace Mysidia\Resource\Test\Native;

use Mysidia\Resource\Native\Object;
use Mysidia\Resource\Test\Test;

class ConcreteObject extends Object
{
}

class ObjectTest extends Test
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
    protected $firstValue;

    /**
     * @var ConcreteObject
     */
    protected $firstObject;

    /**
     * @var int
     */
    protected $secondValue;

    /**
     * @var ConcreteObject
     */
    protected $secondObject;

    protected function setUp()
    {
        parent::setUp();

        $this->firstValue = 1;

        $this->firstObject = new ConcreteObject($this->firstValue);

        $this->secondValue = 2;

        $this->secondObject = new ConcreteObject($this->secondValue);
    }
}
