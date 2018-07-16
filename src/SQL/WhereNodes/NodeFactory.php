<?php

namespace CodingAvenue\Proof\SQL\WhereNodes;

class NodeFactory
{
    public static function getNode(string $nodeName)
    {
        $nodes = self::getNodes();

        if (array_key_exists($nodeName, $nodes)) {
            return new $nodes[$nodeName];
        } else {
            throw new \Exception("Unknown node {$nodeName}");
        }
    }

    public static function getNodes()
    {
        return array(
            'column' => '\CodingAvenue\Proof\SQL\WhereNodes\Column',
            'const'  =>  '\CodingAvenue\Proof\SQL\WhereNodes\Const_',
            'range'  =>  '\CodingAvenue\Proof\SQL\WhereNodes\Range'
        );
    }
}