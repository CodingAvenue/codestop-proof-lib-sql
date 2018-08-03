<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Update;

class UpdateParser
{
    public function parse(array $attributes = array())
    {
        return new Update(array('table' => $attributes[0]['base_expr']));
    }
}