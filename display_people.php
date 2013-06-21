<!DOCTYPE html>
<html>
	<head>
		<title>FM Plus | Display People</title>
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
			echo '<p><a href="createperson.php">Add a new person</a></p>';
			$accountid = get_current_session_account();

            if ( !empty($_POST['person_code']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['person_id']) )
            {
                $person_code = get_post('person_code');
                $first_name = get_post('first_name');
                $last_name = get_post('last_name');
                $person_id = mysql_real_escape_string($_POST['person_id']);

                $update_query = "UPDATE fmp_person SET person_code = '$person_code', first_name = '$first_name', last_name = '$last_name' WHERE person_id = $person_id";
                mysql_query($update_query) or die("there was problem with the query");
                echo "<br/><p>Person Updated</p>";

            }

			//$array_of_columns = array("building_id", "building_code", "building_name", "account_id");
			//display_table($array_of_columns, "fmp_building");
			$query = "SELECT person_id, person_code, first_name, last_name" .
			" FROM fmp_person WHERE active_flag > 0 AND account_id = '$accountid'";

            $cols_array = array("Person Code","First Name","Last Name");
            display_table($cols_array, $query, 1, 1, "edit_person.php", "display_people.php");
			
			display_footer();
			mysql_close();
		?>

	</body>
</html>