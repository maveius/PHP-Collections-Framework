<?php

namespace Mysidia\Resource\Native\Traits;

use Mysidia\Resource\Native;

trait FlagsTrait
{
    /**
     * @var bool
     */
    protected $makeFluent = false;

    /**
     * @var bool
     */
    protected $useObjectParameters = false;

    /**
     * @param null|int $flags
     */
    public function setFlags($flags = null)
    {
        if ($flags !== null) {
            if ($flags & Native\MakeFluent) {
                $this->makeFluent = true;
            }

            if ($flags & Native\UseObjectParameters) {
                $this->useObjectParameters = true;
            }
        }
    }
}
