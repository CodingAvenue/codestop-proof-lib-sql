<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

class KeywordParserFactory
{
    public static function getParser(string $keyword)
    {
        $parsers = self::getKeywordParsers();

        if (isset($parsers[$keyword])) {
            $parser = $parsers[$keyword];

            return new $parser();
        }

        throw new \Exception("No Parser found for keyword {$keyword}");
    }

    public static function getKeywordParsers()
    {
        return array(
            'SELECT'    => '\CodingAvenue\Proof\SQL\Parser\Keyword\SelectParser',
            'FROM'      => '\CodingAvenue\Proof\SQL\Parser\Keyword\FromParser',
            'WHERE'     => '\CodingAvenue\Proof\SQL\Parser\Keyword\WhereParser',
            'DELETE'    => '\CodingAvenue\Proof\SQL\Parser\Keyword\DeleteParser',
            'INSERT'    => '\CodingAvenue\Proof\SQL\Parser\Keyword\InsertParser',
            'VALUES'    => '\CodingAvenue\Proof\SQL\Parser\Keyword\ValuesParser',
            'CREATE'    => '\CodingAvenue\Proof\SQL\Parser\Keyword\CreateParser',
            'TABLE'     => '\CodingAvenue\Proof\SQL\Parser\Keyword\TableParser',
            'UPDATE'    => '\CodingAvenue\Proof\SQL\Parser\Keyword\UpdateParser',
            'SET'       => '\CodingAvenue\Proof\SQL\Parser\Keyword\SetParser'
        );
    }
}