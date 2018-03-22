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
            "dbname"    => "",
            "user"      => "",
            "password"  => "",
            "host"      => "localhost",
            "driver"    => "pdo_pgsql",
            "binPath"   => "vendor/bin",
            "queryFilePath" => "/code"
        ];
    }

    public function getDbConn()
    {
        return array(
            "dbname"    => $this->config['dbname'],
            "user"      => $this->config['user'],
            "password"  => $this->config['password'],
            "host"      => $this->config['host'],
            "driver"    => $this->config['driver']
        );
    }

    public function getQueryFilePath()
    {
        return $this->config['queryFilePath'];
    }

    public function getBinPath()
    {
        return $this->config['binPath'];
    }

    public function getDBName()
    {
        return $this->config['dbname'];
    }

    public function getUser()
    {
        return $this->config['user'];
    }

    public function getPassword()
    {
        return $this->config['password'];
    }

    public function getHost()
    {
        return $this->config['host'];
    }

    public function getDriver()
    {
        return $this->config['driver'];
    }
}
