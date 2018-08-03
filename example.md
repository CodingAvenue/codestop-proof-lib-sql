## INSERT

```sql
INSERT INTO employee_records
VALUES 
    ('Michael Ruiz', 'Javascript Developer', 'San Francisco', '2009/09/15', 205500),
    ('John', 'Javascript Developer', 'LA', '2008/09/15', 205000),
    ('John', 'Javascript Developer', NULL, '2008/09/15', 205000);
```

```php
$sql = new SQL('./code');

// TO get the INSERT CLAUSE
$insert = $sql->find('INSERT');

// TO get the INSERT CLAUSE WITH SPECIFIC TABLE
$insert = $sql->find('INSERT[table="emploee_records"]');

// To GET the VALUES clause
$values = $sql->find('VALUES');

// To get the values clause with specific data
$values = $sql->find('VALUES[data="la"]'); // data attribute is case insensitive, `la` and `LA` will match the same record.
```

## UPDATE

```sql
UPDATE foo SET bar = 'baz';
```

```php
$sql = new SQL('./code');

// Get the UPDATE clause
$update = $sql->find('UPDATE');
// Get the UPDATE clause that uses the foo table. Matches the query above.
$update = $sql->find('UPDATE[table="foo"]');

// Get the SET clause.
$set = $sql->find('SET');
// Will match the set cause above also.
$set = $sql->find('SET[column="bar", value="baz"]'); 

// WHERE clause follows the WHERE clause below.
```

## DELETE

```sql
DELETE from foo WHERE bar = 'baz';
```

```php
$sql = new SQL('./code');

// Get the DELETE clause. If it returns anything, then the query has a DELETE clause on it.
$delete = $sql->find('DELETE');

// FROM clause of DELETE is the same with the other FROM CLAUSE.
// WHERE clause of DELETE is the same with the other WHERE CLAUSE.
```

## WHERE

```php
$sql = new SQL('./code');

$where = $sql->find('where[operator="<"]'); // Will match all where clause with a '<' operator.

// Then to test if the "<" operator is using a column/value that we expect
$where->find('filter[type="column", value="foo"]'); // Will match the "<" operator if it is using the 'foo' column.

$where->find('filter[type="const", value="1"]'); // Will match the "<" operator if the right hand of the operator is a constant 1.

$where = $sql->find('where[operator="between"]'); // Will match "between" operator.

$where->find('filter[type="column", value="foo"]'); // WIll match the foo column used by the between operator.
$where->find('filter[type="range", start="1", end="3"]'); // Will match between range from 1 - 3.
```

### Supported WHERE operators

 - `<`
 - `>`
 - `=`
 - `<=`
 - `>=`
 - `is`
 - `is-not`
 - `between`

### Supported filter attributes

 - `type` 
 - `value`
 - `const`
 - `range`
 - `start`
 - `end`