<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Delete;

class DeleteParser
{
    public function parse(array $attributes = array())
    {
        return new Delete(array());
    }
}