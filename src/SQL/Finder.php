<?php

namespace CodingAvenue\Proof\SQL;

use CodingAvenue\Proof\SelectorParser\Parser;
use CodingAvenue\Proof\SelectorParser\Transformer\ArrayTransformer;
use CodingAvenue\Proof\SQL\KeywordFactory;

use PHPSQLParser\PHPSQLParser;


class Finder {
    /** @var Array $parsed the parsed SQL query */
    private $parsed;

    public function __construct(string $query)
    {
        $sqlParser = new PHPSQLParser();
        $this->parsed = $sqlParser->parse($query);
    }

    public function find(string $rawSelector): array
    {
        $selector = $this->parseSelector($rawSelector);

        $keywordFactory = new KeywordFactory($this->parsed);
        $keyword = $keywordFactory->getKeywordClass($selector['keyword']);

        return $keyword->filter(isset($selector['attribute']) ? $selector['attribute'] : []);
    }

    public function parseSelector(string $selector)
    {
        $parser = new Parser($selector);
        $stream = $parser->parse();

        $transformer = new ArrayTransformer($stream);
        return $transformer->transform();
    }
}