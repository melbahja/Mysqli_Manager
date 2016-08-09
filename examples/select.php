<?php

/**
 * select example
 */

require 'db_config.php';

/* Connect DB */
$db->conn();

// select one 
// ex : $db->escape($_GET['id'])

$id = $db->escape(1);

$ex1 = $db->select_one('title, description, text', 'example_table', "WHERE id='$id'");
echo 'select_one<br/>';
if ($ex1 !== null) {

	echo $ex1['title'] . '<br />';
	echo $ex1['description']. '<br />';
	echo $ex1['text'];

}


echo '<br /><br /><br /><br /> SELECT <br/><br />';

// select 

$ex2 = $db->select('title, description, text', 'example_table', 'LIMIT 10');

while ($ex = $ex2->fetch_assoc()) {

	echo $ex1['title'] . '<br />';
	echo $ex1['description']. '<br />';
	echo $ex1['text']. '<br/><br/><br/>';
}

$ex2->close();

$db->close();


?>
