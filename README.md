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
### FROM keyword

```php

$sql->find("FROM");

// Finding FROM keyword with specific table

$sql->find("FROM[table='foo']");
```

### WHERE keyword

```php
$sql->find("WHERE");

// Finding WHERE keyword with specific filter

$sql->find("WHERE-OPERATOR[operator='=', column='foo', value='bar']"); // Will match WHERE foo = 'bar'
$sql->find("WHERE-OPERATOR[operator='between', column='foo', start='1', end='10]"); // Will match WHERE foo between 1 and 2
```

#### Supported Operators

 - `=`
 - `>`
 - `>=`
 - `<`
 - `<=`
 - `is`
 - `is not`
 - `like`
 - `and`
 - `or`
 - `between`
 - `+`

### INSERT keyword

```php
$sql->find('INSERT');

$sql->find('INSERT[table="foo"]'); // Will match INSERT INTO foo syntax
$sql->find('INSERT[table="foo", column="bar"]'); // Will match INSERT INTO foo (bar) syntax
```

### Values keyword

```php
$sql->find('VALUES'); // Will match the VALUES nodes
$sql->find('VALUES[data="baz"]'); // Will match INSERT INTO foo VALUES(baz) syntax
```

### Create

```php

$sql->find("CREATE"); // Will match CREATE node of the CREATE TABLE syntax
```

### TABLE

```php
$sql->find("TABLE"); // Will match the TABLE node of the CREATE TABLE syntax
$sql->find('TABLE[table="foo"]'); // Will match CREATE TABLE foo
$sql->find('TABLE[table="foo", primaryKey="bar"]'); // Will match CREATE TABLE foo with column bar as the primary key.

// To match create table with column definition:
// Note column, type and length are not required
$sql->find('TABLE[table="foo", primaryKey="bar", column="baz", type="varchar", length="25"]'); // Will match CREATE TABLE foo (baz varchar(25))
```

### DELETE

```php
$sql->find("DELETE");
```

### UPDATE

```php
$sql->find('UPDATE');
$sql->find('UPDATE[table="foo"]'); // Will match UPDATE foo
```

### SET

```php
$sql->find('SET'); // Will match SET syntax
$sql->find('SET-OPERATOR[operator="=", column="bar", value="1"]'); // Will match SET bar = 1.
$sql->find('SET-OPERATOR[operator="+", left="salary", right="1"'); // Will match SALARY + 1
$sql->find('SET-OPERATOR[operator="-", left="salary", right="1"'); // Will match SALARY - 1

// If you want to check for something like SET salary = salary + 1

$setSal = $sql->find('SET-OPERATOR[operator="=", column="salary"]');
$setSalRight = $setSal->find('SET-OPERATOR[operator="+", left="salary", right="1"]');
```