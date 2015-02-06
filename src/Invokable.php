<?php

namespace Mysidia\Resource;

/**
 * Invokes the object
 *
 * @author Christopher Pitt <cgpitt@gmail.com>
 */
interface Invokable
{
    /**
     * Invokes the object
     *
     * @return mixed
     */
    public function __invoke();
}
