<?php

namespace CodingAvenue\Proof;

use CodingAvenue\Proof\Config;

/**
 * BinFinder class part of the SQL Proof Library package
 * Allow components of the Proof Library, to find the binary script it needed.
 */
class BinFinder
{
    /** @var Config $config the Proof Config instance */
    private $config;

    /** @var String $binPath the path to the vendor's bin directory of this installation */ 
    private $binPath;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Returns the path of a binary specified by $bin.
     * Throws an Exception if the binary cannot be found.
     *
     * @param string $bin The name of the binary file.
     */
    public function getBin(string $bin)
    {
        $binary = implode(DIRECTORY_SEPARATOR, array("vendor", "bin", $bin));
        if (file_exists($binary)) {
            return $binary;
        }
        elseif (file_exists(implode(DIRECTORY_SEPARATOR, array(__DIR__, "bin", $bin)))) {
            // We're not part of a composer installation and we need to call OUR binaries. Should only be used by eval-runner for now
            return implode(DIRECTORY_SEPARATOR, array(__DIR__, "bin", $bin));
        }

        throw new \Exception("Unknown binary {$bin}.");
    }

    /**
     * Returns the PHPUnit binary
     */
    public function getPHPUnit()
    {
        return $this->getBin("phpunit");
    }

    /**
     * Returns the ProofRunner binary
     */
    public function getProofRunner()
    {
        return $this->getBin("proof-runner");
    }
}
