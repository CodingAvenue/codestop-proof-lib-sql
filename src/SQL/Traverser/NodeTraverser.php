<?php

namespace CodingAvenue\Proof\SQL\Traverser;

class NodeTraverser
{
    /** @var array $visitors an array of visitors that will be called each time the class enter a new node. */
    private $visitors;

    public function __construct()
    {
        $this->visitors = [];
    }

    public function addVisitor($visitor)
    {
        $this->visitors[] = $visitor;
    }

    public function traverse(array $nodes): array
    {
        $outNodes = [];

        foreach ($nodes as &$node) {
            foreach ($this->visitors as $visitor) {
                $return = $visitor->enter($node);

                if ($return != null) {
                    $outNodes[] = $return;
                } else {
                    if (is_object($node)) {
                        //echo "Inside traverse\n";
                        //print_r($node);
                        //echo "After printing\n";
                        $outNodes = array_merge($outNodes, $this->traverse($node->getSubNodes()));
                    }
                }
            }
        }

        return $outNodes;
    }
}