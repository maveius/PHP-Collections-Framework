<?php

namespace Mysidia\Resource\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * This is a hook for future cross-cutting concerns.
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
abstract class Test extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
