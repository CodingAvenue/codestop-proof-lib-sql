<?php

namespace CodingAvenue\Proof;

/**
 * Configuration class used by the Sql class.
 * TODO - We don't need this class anymore.
 */

class Config
{
    /** @var String $binPath the binary path of the course */
    private $binPath;

    /**
     * Constructor - loads the configuration file (proof.json).
     */
    public function __construct()
    {
        $this->binPath = 'vendor/bin';
    }

    public function getBinPath()
    {
        return $this->binPath;
    }
}
