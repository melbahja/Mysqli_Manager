<?php 



require 'db_config.php';


/* Connect DB */
$db->conn();


// insert 

$data = array(
	'title' => 'test title insert',
	'description' => 'test description insert',
	'text' => 'test text insert',
	);

if ($db->insert('example_table', $data)) {

	// true 
	echo 'success insert_id = ' . $db->insert_id;

} else {

	//false
}

$db->close();
?>
