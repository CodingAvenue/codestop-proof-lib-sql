<?php

namespace CodingAvenue\Proof\SQL\Rule;

use CodingAvenue\Proof\SQL\Traverser\Visitor;
use CodingAvenue\Proof\SQL\Traverser\NodeTraverser;

abstract class Rule implements RuleInterface
{
    public function __construct(array $filter = array())
    {
        $this->filter = $filter;

        $this->checkOptionalFilter();
    }

    public function applyRule(array $nodes)
    {
        $visitor = new Visitor($this->getRule());
        $traverser = new NodeTraverser();
        $traverser->addVisitor($visitor);
        return $traverser->traverse($nodes);

        //return $visitor->getFoundNodes();
    }

    /**
     * Checks the filter property of this Rule and validate it agains't the allowedOptionalFilter list
     * This allows us to inform the user that they are passing something on the filter that we cannot use
     * 
     * @throws Exception when one of the filter property keys is not on the allowed optional filter list.
     */
    public function checkOptionalFilter()
    {
        $allowed = $this->allowedOptionalFilter();
  
        foreach ($this->filter as $key => $value) {
            if (!in_array($key, $allowed)) {
                throw new \Exception(get_class($this) . " allowed optional filters are " . implode(",", $allowed));
            }
        }
    }

    /** 
     * abstract function getRule() Returns the callback that will be used to test against each node on the NodeTraverser class.
     *
     * @return callable $callBack
     */
    abstract function getRule(): callable;

    /** 
     * abstract function allowedOptionalFilter()
     * a list of allowed optional filter of this rules
     * 
     * @return array The allowed optional filter for this rule.
     */
    abstract function allowedOptionalFilter();
}