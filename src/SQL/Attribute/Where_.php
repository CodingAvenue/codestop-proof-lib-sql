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
        $value = $attributes['value'][0];

        while ($ctr < count($this->attributes)) {
            $attribute = $this->attributes[$ctr];

            if ($attribute['expr_type'] == 'colref' && $attribute['base_expr'] == $column) {
                $found[] = $attribute;
                $ctr++;
                $attribute = $this->attributes[$ctr];
                if ($attribute['expr_type'] == 'operator' && $attribute['base_expr'] == $operator) {
                    $found[] = $attribute;
                    $ctr++;
                    $attribute = $this->attributes[$ctr];
                    if ($attribute['expr_type'] == 'const' && preg_match("/^('|\")$value('|\")$/", $attribute['base_expr'])) {
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
        }

        return $found;
    }

    public function knownAttributes()
    {
        return array('columns', 'operator', 'value');
    }
}