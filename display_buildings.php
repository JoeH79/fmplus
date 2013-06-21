<!DOCTYPE html>
<html>
	<head>
		<title>FM Plus | Display buildings</title>
		<link rel='stylesheet' type='text/css' href='styles.css' />
        <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
	</head>
	<body>

		<?php
			require_once 'functions.php';
			require_once 'functions_dbconnect.php';
			require_once 'functions_layout.php';
			require_once 'functions_security.php';

			db_connect();
			ini_set('display_errors',1);
			error_reporting(E_ALL);

			display_header();
			display_menu();	
			echo '<p><a href="createbuilding.php">Add a new building</a></p>';
			$accountid = get_current_session_account();
			
			//$array_of_columns = array("building_id", "building_code", "building_name", "account_id");
			//display_table($array_of_columns, "fmp_building");
			$query = "SELECT building_id, building_code, building_name" .
			" FROM fmp_building WHERE active_flag > 0 AND account_id = '$accountid'";
            $cols_array= array("Building Code", "Building Name");
			display_table($cols_array, $query, 1, 1, "edit_building.php", "display_buildings.php");

			display_footer();
			mysql_close();
		?>

	</body>
</html>