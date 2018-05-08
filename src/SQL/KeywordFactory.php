<?php

namespace CodingAvenue\Proof\SQL;

class KeywordFactory
{
    public function __construct(array $parsedSQL)
    {
        $this->parsed = $parsedSQL;
    }

    public function getKeywordClass(string $key)
    {
        $keywords = self::getKeywords();

        $keyword = $keywords[$key];

        return new $keyword($this->parsed);
    }

    public static function getKeywords()
    {
        return array(
            'SELECT'    => '\CodingAvenue\Proof\SQL\Keyword\Select',
            'FROM'      => '\CodingAvenue\Proof\SQL\Keyword\From',
            'INSERT'    => '\CodingAvenue\Proof\SQL\Keyword\Insert',
            'WHERE'    => '\CodingAvenue\Proof\SQL\Keyword\Where'
        );
    }
}