<?php 

require 'db_config.php';

/* Connect DB */
$db->conn();

$data = array(

	'title' => 'update title',
	'description' => 'update desc',
	'text'  => 'update text'
);


if ($db->update('example_table', $data, 'WHERE id=1')) {

	// true 
	echo 'updated';
	
} else {

	// false 

}



/**
if ($db->delete('example_table', 'WHERE id=2')) {

	//true 
	echo 'deleted';
	
} else {

	//false
}
**/


$db->close();

?>
