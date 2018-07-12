<?php

namespace CodingAvenue\Proof\SQL\Attribute;

class Where_
{
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * $attributes param is an array with key columns, operator and
     */
    public function find(array $attributes)
    {
        $found = [];
        $ctr = 0;

        $column = $attributes['columns'][0];
        $operator = $attributes['operator'][0];
        $value = strtolower($attributes['value'][0]);

        while ($ctr < count($this->attributes)) {
            $attribute = $this->attributes[$ctr];

            if ($attribute['expr_type'] == 'colref' && $attribute['base_expr'] == $column) {
                $found[] = $attribute;
                $ctr++;

                $temp_operators = [];
                while($ctr < count($this->attributes)) { // Searching for an operator may need one or more attributes.
                    $attribute = $this->attributes[$ctr];

                    if ($attribute['expr_type'] == 'operator') {
                        $temp_operators[] = $attribute;
                        $ctr++;
                        continue;
                    }

                    break;
                }
                if (count($temp_operators) > 0) {
                    $ops = array_map(function($att) {
                        return strtolower($att['base_expr']);
                    }, $temp_operators);

                    if (strtolower($operator) == implode(" ", $ops)) {
                        $found[] = $temp_operators;
                        $attribute = $this->attributes[$ctr];

                        if ($attribute['expr_type'] == 'const' && preg_match('/([\'"]?)' . $value . '\1/', strtolower($attribute['base_expr']))) {
                            $found[] = $attribute;
                            break;
                        } else {
                            $found = []; //Reset the found attributes
                            $ctr++;
                        }
                    } else {
                        $found = [];
                        $ctr++;
                    }
                } else {
                    $found = [];
                    $ctr++;
                }
            } else {
                $found = [];
                $ctr++;
            }
        }

        return $found;
    }

    public function knownAttributes()
    {
        return array('columns', 'operator', 'value');
    }
}