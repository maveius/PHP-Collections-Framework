<?php

namespace Mysidia\Resource\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * This is a hook for future cross-cutting concerns.
 *
 * @category  Resource
 * @package   Native
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 * @abstract
 */
abstract class Test extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
