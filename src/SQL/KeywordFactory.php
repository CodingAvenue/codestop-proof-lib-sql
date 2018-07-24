<?php

namespace CodingAvenue\Proof\SQL;

/**
 * SQL KeywordFactory class.
 * Manages all the supported keyword by this proof library.
 * Returns the class that would handle a supported keyword.
 */
class KeywordFactory
{
    /** @var Array $parsedSQL the parsed SQL */
    private $parsed;

    public function __construct(array $parsedSQL)
    {
        $this->parsed = $parsedSQL;
    }

    /**
     * Finds a keyword class based on the given keyword.
     * Returns an instance of the keyword class if found.
     * throws an exception if no keyword class has found.
     * 
     * @param String $key the keyword to be lookup.
     * @return an instance of the Keyword class it found.
     */
    public function getKeywordClass(string $key)
    {
        $keywords = self::getKeywords();

        $keyword = $keywords[$key];

        if ($keyword) {
            return new $keyword($this->parsed);
        } else {
            throw new \Exception("Unsupported keyword {$keyword}");
        }
    }

    public static function getKeywords()
    {
        return array(
            'SELECT'    => '\CodingAvenue\Proof\SQL\Keyword\Select',
            'FROM'      => '\CodingAvenue\Proof\SQL\Keyword\From',
            'INSERT'    => '\CodingAvenue\Proof\SQL\Keyword\Insert',
            'WHERE'    => '\CodingAvenue\Proof\SQL\Keyword\Where',
            'VALUES'    => '\CodingAvenue\Proof\SQL\Keyword\Values',
            'UPDATE'    => '\CodingAvenue\Proof\SQL\Keyword\Update',
            'SET'       => '\CodingAvenue\Proof\SQL\Keyword\Set'
        );
    }
}