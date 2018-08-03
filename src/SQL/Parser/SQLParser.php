<?php

namespace CodingAvenue\Proof\SQL\Parser;

use PHPSQLParser\PHPSQLParser;

use CodingAvenue\Proof\SQL\Parser\Keyword\KeywordParserFactory;

class SQLParser
{
    private $parser;

    public function __construct()
    {
        $this->parser = new PHPSQLParser();
    }

    public function parse(string $sql)
    {
        $parsedSQL = $this->parser->parse($sql);

        $nodes = array();
        foreach ($parsedSQL as $keyword => $attributes) {
            $parser = KeywordParserFactory::getParser($keyword);

            $nodes[] = $parser->parse($attributes);
        }

        return $nodes;
    }
}