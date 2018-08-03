<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Create;

class CreateParser
{
    public function parse(array $attributes = array())
    {
        return new Create(array());
    }
}