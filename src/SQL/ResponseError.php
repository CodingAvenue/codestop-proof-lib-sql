<?php

namespace CodingAvenue\Proof\SQL;

/**
 * SQL Proof Response Error class
 * Represents an error generated from a query.
 */
class ResponseError
{
    /** @var string $message the error message from the query */
    private $message;

    /** @var PDOStatement $stmt the PDO Statement instance */

    public function __construct(string $message, \PDOStatement $stmt)
    {
        $this->message = $message;
        $this->stmt = $stmt;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getStmt()
    {
        return $this->stmt;
    }
}
