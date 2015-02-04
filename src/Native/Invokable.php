<?php

namespace Mysidia\Resource\Native;

/**
 * Defines methods for invoking objects.
 *
 * @category  Resource
 * @package   Collection
 * @author    Christopher Pitt <cgpitt@gmail.com>
 * @copyright Mysidia RPG, Inc
 * @link      http://www.mysidiarpg.com
 */
interface Invokable
{
    /**
     * Invokes the object.
     *
     * @return mixed
     */
    public function __invoke();
}
