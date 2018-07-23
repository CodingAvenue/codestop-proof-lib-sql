<?php

namespace CodingAvenue\Proof\SQL\Attribute;

class Values_
{
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function find(string $needle)
    {
        $found = [];
        foreach ($this->attributes as $attribute) {
            if ($attribute['expr_type'] == 'record') {
                foreach ($attribute['data'] as $data) {
                    if ($needle == $data['base_expr'] || preg_match('#^(["\'])' . strtolower($needle) . '\1#', strtolower($data['base_expr']))) {
                        $found[] = $attribute;
                        break;
                    }
                }
            }
        }

        return $found;
    }

    public function knownAttributes()
    {
        return array('data');
    }
}