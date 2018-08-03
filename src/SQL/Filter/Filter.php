<?php

namespace CodingAvenue\Proof\SQL\Filter;

abstract class Filter implements FilterInterface
{
    /** @var string $name the name of the filter class */
    protected $name;

    /** @var array $attributes An array of attributes that will use to determine the Rule Class to apply */
    protected $attributes;

    public function __construct(string $name, array $attributes)
    {   
        $this->name = $name;
        $this->attributes = $attributes;
    }   

    public function applyFilter(array $nodes): array
    {   
        $rule = $this->getRuleClass();
        return $rule->applyRule($nodes);
    }   

    public function subNodes(): array
    {   
        return array();
    }   

    abstract function getRuleClass();

    abstract function getRuleFilter();
}
