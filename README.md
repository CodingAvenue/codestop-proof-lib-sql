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

### Loading

```php
use CodingAvenue\Proof\SQL;

$sql = new SQL();
```

### SELECT keyword

```php
$sql->find("SELECT");

// Finding if the SELECT keyword specifies a specific column or a *

$sql->find("SELECT[columns='*']");
$sql->find("SELECT[columns='foo']");
```

### WHERE keyword

```php
$sql->find("WHERE");

// Finding WHERE keyword with specific filter

$sql->find("WHERE[columns='foo', operator='=', value='bar']"); // Will match WHERE foo = 'bar'
```

### FROM keyword

```php

$sql->find("FROM");

// Finding FROM keyword with specific table

$sql->find("FROM[table='foo']");
```
