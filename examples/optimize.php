<?php 

require 'db_config.php';

/* Connect DB */
$db->conn();

if ($db->optimize_table('tableName')) {

	// true

}


// optimize all tables

if ($db->optimize_db()) {

	// true

}



$db->close();


?>
