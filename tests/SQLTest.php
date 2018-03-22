<?php

use PHPUnit\Framework\TestCase;
use CodingAvenue\Proof\SQL;
use CodingAvenue\Proof\SQL\Response;

class SQLTest extends TestCase
{
    //public function testConstruct()
    //{
    //    $sql = new SQL();

    //    $this->assertInstanceOf(SQL::class, $sql, "\$sql is an instance of SQL class");
    //}

    public function testQuery()
    {
        putenv("PROOF_LIBRARY_MODE=local");

        $settings = array(
            "dbname"    => "sqlproofdb",
            "user"      => "sqlproofuser",
            "password"  => "sqlproofpassword",
            "host"      => "localhost",
            "driver"    => "pdo_pgsql",
            "queryFilePath" => "./code" 
        );

        $proofFH = fopen('./proof.json', 'w');
        fwrite($proofFH, json_encode($settings));

        $codeFH = fopen('./code', 'w');
        fwrite($codeFH, 'SELECT * FROM users');

        $sql = new SQL();

        $response = $sql->query();

        $this->assertInstanceOf(Response::class, $response, "\$response is an instance of the Response class");

    }

    public static function tearDownAfterClass()
    {
        putenv("PROOF_LIBRARY_MODE");
        unlink("./proof.json");
        unlink("./code");
    }
}