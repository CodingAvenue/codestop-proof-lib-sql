<?php

namespace CodingAvenue\Proof;

/**
 * Configuration class used by the Sql class.
 */

class Config
{
    /** @var dbconn the database connection parameters */
    private $config;

    /** @var bool $sandboxMode determine if we're running inside the sandbox. This would skip proof.json if we're inside the sandbox */
    private $sandboxMode;

    /**
     * Constructor - loads the configuration file (proof.json).
     */
    public function __construct()
    {
        $configFile = realpath('proof.json') ?: null;

        $this->sandboxMode = getenv("PROOF_LIBRARY_MODE") === 'local' ? false : true;

        if ($configFile && file_exists($configFile)) {
            $config = json_decode(file_get_contents($configFile), true);
            $config = array_merge($this->getDefaultConfiguration(), $config);

            $this->config = $config;
        }
        else {
            $config = $this->getDefaultConfiguration();

            $this->config = $config;
        }
    }

    /**
     * We need to set this to make sure that when we run the proof file on the sandbox server ( live instance ), it would ignore the proof.json file
     * which is just for local testing.
     */
    protected function getDefaultConfiguration()
    {
        return [
            "binPath"   => "vendor/bin",
            "queryFilePath" => "./code"
        ];
    }

    public function getQueryFilePath()
    {
        return $this->config['queryFilePath'];
    }

    public function getBinPath()
    {
        return $this->config['binPath'];
    }
}
