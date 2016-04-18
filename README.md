# mysqli_manager
Access MySQL database using MySQLi , OOP PHP Class

## Examples

### example table 
```sql
--
-- example Table
--
CREATE TABLE `test` (
  `pid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `test` (`pid`, `title`, `page`) VALUES
(1, ' FAQ page title', 'Example Content');

ALTER TABLE `test`
  ADD PRIMARY KEY (`pid`);
ALTER TABLE `test`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
```  

###Config
```php
<?php

// config 
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');
define('DB_HOST', 'localhost');

require_once('mysqli_manager.php');

$db = new mysqli_manager();

```

###SELECT data Example
```php
// $db->select(Column, table Name, WHERE(optional) ) 

if ( $row = $db->select('title, page', 'test', 'LIMIT 1') { 
    $title = $row['title'];
    $page_text = $row['page'];
}
unset($row);

echo $title;
echo $page_text;

//example 2
$id = $db->escape($_GET['id']); // escape 

if ( $row = $db->select('title, page', 'test', "WHERE pid=$id") { 

    if ($db->num_rows > 0) {
        $title = $row['title'];
         $page_text = $row['page'];
    } else {
      echo 'Not Found';
    }

}
unset($row);
```
###SELECT data for loop 
```php
$data = $db->loopselect('pid, title, page', 'test', 'LIMIT 10');

if ($data->num_rows > 0) {
// fetch_assoc() return data as array 
// fetch_object() return data as object 
     while( $row = $data->fetch_assoc() ) {
       echo 'Pgae id ' . $row['pid'];
       echo 'Pgae title ' . $row['title'];
       echo 'Pgae content ' . $row['page'];
     }
} else {
  echo 'Not Found';
}
$data->close();// close() or free()
```

### INSERT data 
```php

// $db->insert(table Name, array )

$data = array(
     'title' => 'Example title insert',
     'page' => 'Example data'
);

 if ($db->insert('test', $data) === TRUE) {
    // TRUE
    echo $db->insert_id();// get insert id
 } else {
   // FALSE
 }
```

### Multi INSERT
```php
$data = array(
     'insert1' => array(
            'title' => 'Example title multi insert 1',
            'page' => 'Example data multi 1'
      ),
      
     'insert2' => array(
            'title' => 'Example title multi insert 2',
            'page' => 'Example data 2'
      ), 
      
     'insert3' => array(
         'title' => 'Example title multi insert 3',
         'page' => 'Example data 3'
      ), 
);

 if ($db->multi_insert('test', $data) === TRUE) {
    // TRUE
   var_dump($db->insert_ids()); // return array : get insert ids
 } else {
   // FALSE
 }
```

###UPDATE data 
```php
$data = array(
     'title' => 'Updated title',
     'page' => 'Updated data'
);

if ($db->update('test', $data, 'WHERE pid=1') === TRUE) {
    // TRUE
 } else {
   // FALSE
}
```

###DELETE data 
```php
// $db->delete(FROM (table name), WHERE)

if( $db->delete('test', 'WHERE pid = 1') === TRUE) {
 // deleted
} else {
 // false
}
```

###Get DB Connection
```php
$DB_connect = $db->conn();
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
