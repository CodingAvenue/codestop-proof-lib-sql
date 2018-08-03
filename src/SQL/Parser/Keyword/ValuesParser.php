<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Values;

class ValuesParser
{
    public function parse(array $attributes = array())
    {
        $records = [];
        foreach ($attributes as $row) {
            $record = [];
            foreach ($row['data'] as $data) {
                $record[] = preg_replace('/(^[\"\']|[\"\']$)/', '', $data['base_expr']);
            }

            $records[] = $record;
        }

        return new Values($records);
    }
}