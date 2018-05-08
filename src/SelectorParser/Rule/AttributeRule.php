<?php

namespace CodingAvenue\Proof\SelectorParser\Rule;

use CodingAvenue\Proof\SelectorParser\Token;
use CodingAvenue\Proof\SelectorParser\TokenStream;
use CodingAvenue\Proof\SelectorParser\Rule\RuleInterface;

class AttributeRule implements RuleInterface
{
    private static $attributes = array('columns', 'value', 'operator', 'tables');

    private $inKey = true;
    private $inValue = false;

    public function startToken(Token $token)
    {
        return $token->getType() === 'open_square_bracket';
    }

    public function endToken(Token $token)
    {
        return $token->getType() === 'close_square_bracket';
    }

    public function unexpectedToken(Token $token)
    {
        return false;
    }

    public function getRuleType()
    {
        return 'attribute';
    }

    public function handle(TokenStream $stream)
    {
        $token = $stream->getCurrentToken(); // Get the current cursor token and check if it satisfy this rule.

        if (!$this->startToken($token)) {
            throw new \Exception("Unsatisfied startToken rule detected. Current stream cursor is at token {$token->getValue()}");
        }

        $token = $stream->getNextToken(); //We move the cursor to the next Token ignoring the open bracket since we don't want that on the result

        $attributeKey = '';
        $attributeValue = '';
        $attribute = array();

        while(!$stream->isEnd()) {
            $token = $stream->getCurrentToken();
            if ($this->endToken($token)) {
                break;
            }

            /**
             * TODO - This needs to be refactored. This is UGLY AS F**K!!
             * Basically, what we wanted to achieve in here is to get the attribute name ( columns in the 'columns="bar" ).
             * Then get the attribute value (bar in the 'columns="bar").
             * The trick is that the value can contain a comma separated value E.g. columns="foo, bar, baz"
             * And a '>, <, =' characters E.g. columns="bar", value="4", operator="=" ( will match a where clause of WHERE bar = 4)
             */
            if ($this->inKey) {
                if ($token->getType() == 'equal') {
                    $this->inKey = false;
                } elseif ($token->getType() != 'comma' && $token->getType() != 'whitespace') {
                    $attributeKey .= $token->getValue();
                }
            } else {
                if (!$this->inValue && $token->getType() == 'quote') {
                    $this->inValue = true;
                } else if ($token->getType() == 'quote') {
                    $this->inValue = false;
                    $this->inKey = true;

                    $attribute[$attributeKey] = preg_split("/,\s*/", $attributeValue);
                    $attributeKey = '';
                    $attributeValue = '';
                } else {
                    $attributeValue .= $token->getValue();
                }
            }
            
            $token = $stream->getNextToken();
        }

        //Check if the current Token satisfy the endToken()
        if (!$this->endToken($token)) {
            throw new \Exception("Expecting an close_square_bracket_token before the end of the stream");
        }

        $token = $stream->getNextToken(); // Move the stream cursor one more time since we don't want the next rule to check the closing bracket

        return $attribute;
    }
}
