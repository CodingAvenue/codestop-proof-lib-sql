<?php

namespace CodingAvenue\Proof\SQL;

/**
 * SQL Proof Response class
 * Represent's the response from an SQL Query. It could be empty or an error message.
 */

class Response
{
    /** @var Array $result the result of the query */
    private $result;

    /** @var PDOStatement $stmt the PDO Statement that was executed */
    private $stmt;

    /**
     * Constructor, takes a result from a DBAL query
     */
    public function __construct($result = array(), \PDOStatement $stmt)
    {
        $this->result = $result;
        $this->stmt = $stmt;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function isEmpty()
    {
        return count($this->result) === 0 ? true : false;
    }

    public function getColumnCount()
    {
        return count($this->getColumnNames());
    }

    public function getColumnNames()
    {
        if (!$this->isEmpty()) {
            return array_keys($this->result[0]);
        }

        return [];
    }

    public function getRowCount()
    {
        return count($this->result);
    }

    public function columnExists(string $column)
    {
        $columns = $this->getColumnNames();

        return in_array($column, $columns);
    }
}
