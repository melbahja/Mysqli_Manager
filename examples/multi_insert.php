<?php 

require 'db_config.php';


$data = array(

	'insert_1' => array(
	      'title' => 'test title',
	      'description' => 'test description',
	      'text' => 'test text',
		),
	'insert_2' => array(
	      'title' => 'test title 2',
	      'description' => 'test description 2',
	      'text' => 'test text 2',
	),
   
   // ......

);


if($db->multi_insert('example_table', $data)) {

	// true 
	// 
	print_r($db->insert_ids);

}else {

	echo 'false';
}

$db->close();
?>