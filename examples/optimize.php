<?php 

require 'db_config.php';


if ($db->optimize_table('help_keyword')) {

	// true

}


// optimize all tables

if ($db->optimize_db()) {

	// true

}



$db->close();


?>