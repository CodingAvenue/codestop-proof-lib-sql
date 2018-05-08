<?php

namespace CodingAvenue\Proof\SQL\Attribute;

class Select_
{
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function find(string $needle)
    {
        $found = [];
        foreach ($this->attributes as $attribute) {
            if ($attribute['expr_type'] == 'colref' && $attribute['base_expr'] == $needle) {
                $found[] = $attribute;
            }
        }

        return $found;
    }

    public function knownAttributes()
    {
        return array('columns');
    }
}