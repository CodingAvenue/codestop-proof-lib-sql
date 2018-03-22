<?php

use PHPUnit\Framework\TestCase;
use CodingAvenue\Proof\Config;

class ConfigTest extends TestCase
{
    public function testConstruct()
    {
        $config = new Config();
        $this->assertInstanceOf(Config::class, $config, "\$config is an instance of Config class");
    }

    public function testDefaultProperties()
    {
        $config = new Config();

        $this->assertEquals("/code", $config->getQueryFilePath(), "queryFilePath default setting is /code");
        $this->assertEquals("", $config->getDBName(), "dbname default setting is ''");
        $this->assertEquals("", $config->getUser(), "user default setting is ''");
        $this->assertEquals("", $config->getPassword(), "password default setting is ''");
        $this->assertEquals("localhost", $config->getHost(), "host default setting is localhost");
        $this->assertEquals("pdo_pgsql", $config->getDriver(), "driver default setting is pdo_pgsql");
    }

    public function testProofJson()
    {
        putenv("PROOF_LIBRARY_MODE=local");

        $settings = array(
            "dbname"    => "sql-test",
            "user"      => "dbuser",
            "password"  => "dbpassword",
            "host"      => "dbhost",
            "driver"    => "dbdriver",
            "queryFilePath" => "/yourSql.sql" 
        );

        $fh = fopen('./proof.json', 'w');
        fwrite($fh, json_encode($settings));
        fclose($fh);

        $config = new Config();

        $this->assertEquals("/yourSql.sql", $config->getQueryFilePath(), "queryFilePath is /yourSql.sql");
        $this->assertEquals("sql-test", $config->getDBName(), "dbname is sql-test");
        $this->assertEquals("dbuser", $config->getUser(), "user is dbuser");
        $this->assertEquals("dbpassword", $config->getPassword(), "password is dbpassword");
        $this->assertEquals("dbhost", $config->getHost(), "host is dbhost");
        $this->assertEquals("dbdriver", $config->getDriver(), "driver is dbdriver");
    }

    public static function tearDownAfterClass()
    {
        putenv("PROOF_LIBRARY_MODE");
        unlink("./proof.json");
    }
}