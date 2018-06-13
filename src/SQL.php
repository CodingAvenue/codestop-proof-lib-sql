<?php

namespace CodingAvenue\Proof;

use CodingAvenue\Proof\Config;
use CodingAvenue\Proof\BinFinder;
use CodingAvenue\Proof\SQL\Finder;

/**
 * SQL class of the Proof Library
 * Main class for the proof library, executes a query and have a way to evaluate the result.
 */

class SQL
{
    /** @var Config $config the Config instance */
    private $config;

    /** @var BinFinder $binFinder the BinFinder instance */
    private $binFinder;

    /** @var Finder $finder the SQL Finder instance */
    private $finder;

    private $query;

    public function __construct(string $answerFile)
    {
        $this->config = new Config();

        if (!file_exists($answerFile)) {
            throw new \Exception("Answer file {$answerFile} not found.");
        }

        $query = file_get_contents($answerFile);
        if (!$query) {
            throw new \Exception("Unable to read answer file {$answerFile}.");
        }

        $this->query = $query;

        $this->finder = new Finder($query);

        $this->binFinder = new BinFinder($this->config);
    }

    /**
     * Calls the Finder class find() method to filter the nodes
     * based on the selector.
     * 
     * @param String $selector the Selector that will be used to filter the node
     * @return Array the array of nodes after the filter has been applied.
     * if no nodes are found, it will return an empty array. 
     */
    public function find(string $selector): array
    {
        return $this->finder->find($selector);
    }

    /**
     * Returns the Config instance of this class.
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function getQuery()
    {
        return $this->query;
    }
}
