<?php

namespace CodingAvenue\Proof\SQL\Attribute;

class Set_
{
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function find(string $column = null, string $value = null)
    {
        $found = [];
        foreach ($this->attributes as $attribute) {
            $subTree = $attribute['sub_tree'];
            $foundIndex = false;

            if (!is_null($column)) {
                if ($subTree[0]['base_expr'] == $column) {
                    $foundIndex = true;
                } else {
                    $foundIndex = false;
                }
            }

            if (!is_null($value) && $foundIndex) {
                if ($value == $subTree[2]['base_expr'] || preg_match('#^(["\'])' . strtolower($value) . '\1#', strtolower($subTree[2]['base_expr']))) {
                    $foundIndex = true;
                } else {
                    $foundIndex = false;
                }
            }

            if ($foundIndex) {
                $found[] = $attribute;
            }
        }

        return $found;
    }

    public function knownAttributes()
    {
        return array('column', 'value');
    }
}