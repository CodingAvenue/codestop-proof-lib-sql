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

## Usage

### Loading

```php
use CodingAvenue\Proof\SQL;

global $code; // This was set by the database API
$sql = new SQL($code);
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
