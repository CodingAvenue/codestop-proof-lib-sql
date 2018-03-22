# CodeStop Proof Library for SQL ( PostgreSQL )

## Installation

Add the following to your `composer.json` file

```
{
    "repositories": {
        "type": "git",
        "url": "https://github.com/CodingAvenue/codestop-proof-library-sql"
    },
    "require": {
        "codingavenue/sql-proof": "~0.1"
    }
}
```
Then do `composer update`

## Local setup Configuration

Create a `proof.json` file on your Course root directory. Below are the supported configuration

 - **dbname** - name of the database to connect to
 - **user** - username that will be used to connect to the DB
 - **password** - password that will be used to connect to the DB
 - **host** - The host of the database, default to localhost
 - **driver** - The DB driver to use, default to pdo_pgsql
 - **queryFilePath** - The path to the file where the query to be executed is saved. Default to /code
 - **binPath** - The path of the bin directory. Default to vendor/bin

## Usage

```php
use CodingAvenue\Proof\SQL;

$sql = new SQL();

$response = $sql->query();

if (get_class($response) === 'Response') { // $response is an instance of Response class
    // Check if the result is empty
    $response->isEmpty();

    // Returns the number of columns in the result.
    $response->getColumnCount(); 

    // Returns the column names on the result.
    $response->getColumnNames(); 

    // returns the number of rows on the result;
    $response->getRowCount(); 

    // Checks if a column $columnName exists on the result;
    $response->columnExists($columnName); 
} else { // $response is an instance of ResponseError. We have an SQL error
    $response->getMessage(); // Is the SQL Error.
}
```

### Running locally

This library includes a proof-runner executable that would allow authors to run their proof files locally. From your root directory

```
./vendor/bin/proof-runner </path/to/your/proof/file.php>
```
