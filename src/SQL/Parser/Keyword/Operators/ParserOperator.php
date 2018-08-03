<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

abstract class ParserOperator
{
    /** @var $nodes an operator instance */
    protected $node; 
    
    /** @var $attributes the attribute to be parse */
    protected $attributes = array();

    public function __construct(array $attributes = array())
    {
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getTypes()
    {
        return array(
            'colref' => 'column',
            'const' =>  'const'
        );
    }

    abstract function parse();
}