<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Select;

class SelectParser
{
    public function parse(array $attributes = array())
    {
        $columns = array();

        $columns = $this->_parse($attributes);
        return new Select($this->_parse($attributes));
        // for ($i = 0; $i < count($attributes); $i++) {
        //     $attribute = $attributes[$i];

        //     if ($attribute['expr_type'] == 'reserved' && strtoupper($attribute['base_expr']) == 'DISTINCT') {
        //         $i++;
        //         $columns[] = [
        //             'name' => $attributes[$i]['base_expr'],
        //             'distinct' => 1
        //         ];
        //     } else if ($attribute['expr_type'] == 'aggregate_function') {
        //         $columns[] = [
        //             'is_aggregate'  => true,
        //             'aggregate_function' => $attribute['base_expr'],
        //             'name'          => $attribute['sub_tree'][0]['no_quotes']['parts'][0]

        //         ];
        //     } else {
        //         $columns[] = [
        //             'name' => $attribute['base_expr']
        //         ];
        //     }
        // }

        //return new Select($columns);
    }

    private function _parse(array $nodes = array()): array
    {
        $columns = [];
        for ($i = 0; $i < count($nodes); $i++) {
            $node = $nodes[$i];
            switch ($node['expr_type']) {
                case 'colref':
                    $column = $this->parseCol($node);
                    break;
                case 'aggregate_function':
                    $column = $this->parseAggregate($node);
                    break;
                case 'function':
                    $column = $this->parseFunction($node);
                    break;
                case 'reserved':
                    $column = $this->parseReserve($node, $nodes[$i+1]);
                    break;
            }

            if (isset($node['alias'])) {
                $column = array_merge($column, ['alias' => $node['alias']['name']]);
            }

            $columns[] = $column;
        }

        return $columns;
    }

    private function parseReserve($node, $nextNode)
    {
        $column = [];
        switch ($node['base_expr']) {
            case 'DISTINCT':
                $column[] = array_merge(['distinct' => 1], $this->parseCol($nextNode));
                break;
        }

        return $column;
    }

    private function parseFunction($node)
    {
        $column = [
            'functionName'  => $node['base_expr'],
            'extraArgs' => $node['sub_tree'][1]['base_expr']
        ];

        return array_merge(
            $this->_parse([$node['sub_tree'][0]])[0],
            $column
        );
    }

    private function parseAggregate($node) 
    {
        $aggregate = [
            'is_aggregate'          => true,
            'aggregate_function'    => $node['base_expr'],
        ];

        foreach ($node['sub_tree'] as $subNode) {
            switch ($subNode['expr_type']) {
                case 'colref':
                    $aggregate = array_merge($this->parseCol($subNode), $aggregate);
            }
        }

        return $aggregate;
    }

    private function parseCol($node)
    {
        return ['name' => $node['no_quotes']['parts'][0]];
    }
}