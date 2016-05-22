# mysqli_manager
Access MySQL database using MySQLi , OOP PHP Class

## Examples

### example table 
```sql
CREATE TABLE `example_table` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(150) CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `example_table` (`id`, `title`, `description`, `text`) VALUES
(1, ' title', ' desc', ' text');

ALTER TABLE `example_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `example_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  
```  

###Config
```php
<?php

/**
 * database config 
 */

define('DB_HOST', 'localhost'); //host
define('DB_USER', 'root'); // db username
define('DB_PASS', ''); // db password 
define('DB_NAME', 'test'); // db name

require_once('Mysqli_Manager.php');

try {

	$db = new Mysqli_Manager();

} catch (Exception $err) {

	exit($err->getMessage());
}

```

###SELECT data Example
```php
// $db->select(Column, table Name, WHERE(optional) ) 

if ( $row = $db->select('title, text', 'example_table', 'LIMIT 1')->fetch_assoc()) { 
    $title = $row['title'];
    $page_text = $row['text'];
}
unset($row);

echo $title;
echo $page_text;

//example 2
$id = $db->escape($_GET['id']); // escape 

if ( $row = $db->select('title, text', 'example_table', "WHERE id=$id") { 

    if ($row->num_rows > 0) {
        $row = $row->fetch_assoc();
        $title = $row['title'];
         $page_text = $row['text'];
    } else {
      echo 'Not Found';
    }

}
unset($row);
```

### INSERT data 
```php

// $db->insert(table Name, array )

$data = array(
     'title' => 'Example title insert',
     'text' => 'Example data'
);

 if ($db->insert('example_table', $data) === TRUE) {
    // TRUE
    echo $db->insert_id;// get insert id
 } else {
   // FALSE
 }
```

### Multi INSERT
```php
$data = array(
     'insert1' => array(
            'title' => 'Example title multi insert 1',
            'text' => 'Example data multi 1'
      ),
      
     'insert2' => array(
            'title' => 'Example title multi insert 2',
            'text' => 'Example data 2'
      ), 
      
     'insert3' => array(
         'title' => 'Example title multi insert 3',
         'text' => 'Example data 3'
      ), 
);

 if ($db->multi_insert('example_table', $data) === TRUE) {
    // TRUE
   var_dump($db->insert_ids); // return array : get insert ids
 } else {
   // FALSE
 }
```

###UPDATE data 
```php
$data = array(
     'title' => 'Updated title',
     'text' => 'Updated data'
);

if ($db->update('example_table', $data, 'WHERE id=1') === TRUE) {
    // TRUE
 } else {
   // FALSE
}
```

###DELETE data 
```php
// $db->delete(FROM (table name), WHERE)

if( $db->delete('example_table', 'WHERE id = 1') === TRUE) {
 // deleted
} else {
 // false
}
```

###Simple query
```php
$query = $db->query("SELECT * FROM mbt_pages WHERE pid=1");
```
###Close DB connetion
```php
// close 
$db->close();
```
