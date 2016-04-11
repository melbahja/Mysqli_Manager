# mysqli_manager
Access MySQL database using MySQL , OOP PHP Class

## Examples

```php
<?php

// config 
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');
define('DB_HOST', 'localhost');

require_once('mysqli_manager.php');

$db = new mysqli_manager();

/*********
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
**********/  

// example SELECT
// $db->select(Column, table Name, WHERE(optional) ) 

if ( $row = $db->select('title, page', 'test', 'LIMIT 1') { 
    $title = $row['title'];
    $page_text = $row['page'];
}
unset($row);

echo $title;
echo $page_text;

// example 2
$id = $db->escape($_GET['id']);

if ( $row = $db->select('title, page', 'test', "WHERE pid=$id") { 

    if ($db->num_rows > 0) {
        $title = $row['title'];
         $page_text = $row['page'];
    } else {
      echo 'Not Found';
    }

}
unset($row);

// example : select for loop
if ($data = $db->selectloop('pid, title, page', 'test', 'LIMIT 10') && $data->num_rows > 0) {

// fetch_assoc() return data as array 
// fetch_object() return data as object 

     while( $row = $data->fetch_assoc() ) {
       echo 'Pgae id ' . $row['pid'];
       echo 'Pgae title ' . $row['title'];
       echo 'Pgae content ' . $row['page'];
     }
  $data->close();   
} else {
  echo 'Not Found';
}

// example insert 
// $db->select(table Name, array )

$data = array(
     'title' => 'Example title insert',
     'page' => 'Example data'
);

 if ($db->insert('test', $data) === TRUE) {
    // TRUE
    echo $db->insert_id();
 } else {
   // FALSE
 }


// example Muli insert

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
   var_dump($db->insert_ids()); // return array
 } else {
   // FALSE
 }

// example update 
$data = array(
     'title' => 'Updated title',
     'page' => 'Updated data'
);

if ($db->update('test', $data, 'WHERE pid=1') === TRUE) {
    // TRUE
 } else {
   // FALSE
}

//example delete
// $db->delete(FROM, WHERE)

if( $db->delete('test', 'WHERE pid = 1') === TRUE) {
 // deleted
} else {
 // false
}

// db connect $db->conn()
// query $db->query("SELECT * FROM mbt_pages WHERE pid=1")

// close 
$db->close();

```
