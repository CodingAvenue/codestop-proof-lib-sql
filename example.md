## Where clause update

```sql
$sql = new SQL('./code');

$where = $sql->find('where[operator="<"]'); // Will match all where clause with a '<' operator.

// Then to test if the "<" operator is using a column/value that we expect
$where->find('filter[type="column", value="foo"]'); // Will match the "<" operator if it is using the 'foo' column.

$where->find('filter[type="const", value="1"]'); // Will match the "<" operator if the right hand of the operator is a constant 1.

$where->find('where[operator="between"]'); //
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