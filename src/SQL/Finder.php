<?php

namespace CodingAvenue\Proof\SQL;

use CodingAvenue\Proof\SelectorParser\Parser;
use CodingAvenue\Proof\SelectorParser\Transformer\ArrayTransformer;
use CodingAvenue\Proof\SQL\KeywordFactory;

use PHPSQLParser\PHPSQLParser;

/**
 * SQL Proof Finder class
 * Parses the SQL String and allows to find a particular node from a selector
 */

class Finder
{
    /** @var Array $parsed the parsed SQL query */
    private $parsed;

    public function __construct(string $query)
    {
        $sqlParser = new PHPSQLParser();
        $this->parsed = $sqlParser->parse($query);
    }

    /**
     * Filters the parsed SQL string from a given selector. 
     * The selector is composed of a keyword (SELECT, INSERT, WHERE)
     * and one or more attributes (table, column, etc...)
     * 
     * @param String $rawSelector the selector string to be used for filtering the node
     * @return Array, an array of nodes after the filter has been applied
     * to the parsed SQL string.
     */
    public function find(string $rawSelector)
    {
        $selector = $this->parseSelector($rawSelector);

        $keywordFactory = new KeywordFactory($this->parsed);
        $keyword = $keywordFactory->getKeywordClass($selector['keyword']);

        return $keyword->filter(isset($selector['attribute']) ? $selector['attribute'] : []);
    }

    /**
     * Parse the selector stirng so it can be properly applied as filter on the parsed
     * SQL string.
     * 
     * @param String $selector the selector string to be parsed
     * @return Array the parsed selector string in an array with two keys
     * 'keyword' and 'attribute'.
     */
    public function parseSelector(string $selector): array
    {
        $parser = new Parser($selector);
        $stream = $parser->parse();

        $transformer = new ArrayTransformer($stream);
        return $transformer->transform();
    }
}