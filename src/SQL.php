<?php

namespace CodingAvenue\Proof;

use CodingAvenue\Proof\Config;
use CodingAvenue\Proof\BinFinder;
use CodingAvenue\Proof\SQL\Response;
use CodingAvenue\Proof\SQL\ResponseError;

/**
 * SQL class of the Proof Library
 * Main class for the proof library, executes a query and have a way to evaluate the result.
 */

class SQL
{
    /** @var Config $config the Config instance */
    private $config;

    /** @var DBAL $conn the database connection*/
    private $conn;

    /** @var string $query the query to be executed. */
    private $query;

    /** @var BinFinder $binFinder the BinFinder instance */
    private $binFinder;

    public function __construct()
    {
        $this->config = new Config();
        $config = new \Doctrine\DBAL\Configuration();

        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($this->config->getDbConn(), $config);

        if (!file_exists($this->getQueryPath())) {
            throw new \Exception("Answer file {$this->getQueryPath()} not found.");
        }

        $query = file_get_contents($this->getQueryPath());
        if (!$query) {
            throw new \Exception("Unable to read answer file {$this->getQueryPath()}.");
        }

        $this->query = $query;
        $this->binFinder = new BinFinder($this->config);
    }

    protected function getQueryPath()
    {
        return $this->config->getQueryFilePath();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function query($sqlQuery = null)
    {
        if (is_null($sqlQuery)) {
            $sqlQuery = $this->query;
        }

        $stmt = '';

        try {
            $stmt = $this->conn->executeQuery($sqlQuery);
            
            return new Response($stmt->fetch(), $stmt);
        } catch (\Doctrine\DBAL\DBALException $e) {
            // Need to get the RAW SQL error message and not the DBAL/PDO error.
            $pre = $e->getPrevious()->getPrevious();

            // errorInfo has the error string that is close to what the DB server is gives us.
            return new ResponseError($pre->errorInfo[2], $stmt);
        }
    }
}
