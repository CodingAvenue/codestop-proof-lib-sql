<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\From;

class FromParser
{
    public function parse(array $attributes = array())
    {
        $tables = array();
        foreach ($attributes as $attribute) {
            $tables[] = $attribute['table'];
        }

        return new From($tables);
    }
}