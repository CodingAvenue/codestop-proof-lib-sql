<?php

namespace CodingAvenue\Proof\SQL\Attribute;

class Update_
{
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function find(string $needle)
    {
        $found = [];
        foreach ($this->attributes as $attribute) {
            if ($attribute['expr_type'] == 'table' && $attribute['table'] == $needle) {
                $found[] = $attribute;
            }
        }

        return $found;
    }

    public function knownAttributes()
    {
        return array('table');
    }
}