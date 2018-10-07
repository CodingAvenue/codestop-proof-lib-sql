<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Set;
use CodingAvenue\Proof\SQL\Operators\Plus_;
use CodingAvenue\Proof\SQL\Operators\Minus_;

class SetParser
{
    public function parse(array $attributes = array())
    {
        $nodes = array();

        foreach ($attributes as $attribute) {
            $setNodes = $attribute['sub_tree'];

            while (count($setNodes) > 0) {
                $handles = false;

                foreach ($this->operatorParsers() as $parserClass) {
                    $parser = new $parserClass($setNodes);

                    $node = $parser->parse();
                
                    if (!is_null($node)) {
                        $handles = true;
                        $setNodes = $parser->getAttributes(); // $attributes is the rest of the attributes that this operator cannot parse.

                        if (in_array(get_class($node), $this->getArithmeticClass())) {
                            list($prev) = array_splice($nodes, -1, 1);
                            $right = $prev->getRight();

                            $node->setLeft($right);
                            $prev->setRight($node);

                            $nodes[] = $prev;

                            break;
                        }

                        $nodes[] = $node; // $node is now an operator instance.

                        break;
                    }
                }

                if (!$handles) {
                    print_r($attributes);
                    throw new \Exception("Unable to find an operator parser for this Set clause");
                }
            }
        }

        return new Set($nodes);
    }

    public function getArithmeticClass()
    {
        return array(
            Plus_::class,
            Minus_::class
        );
    }

    public function operatorParsers()
    {
        return array(
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\EqualParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\GreaterParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\GreaterEqualParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\LessParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\LessEqualParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\LikeParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\IsNotParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\IsParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\InParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\BetweenParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\AndParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\OrParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\PlusParser',
            '\CodingAvenue\Proof\SQL\Parser\Keyword\Operators\MinusParser'
        );
    }


}