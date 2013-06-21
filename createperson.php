<!DOCTYPE html>
<html>
	<head>
		<title>FM Plus | Create new person</title>
		<link rel='stylesheet' type='text/css' href='styles.css' />
        <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<h1>Create new person</h1>
		<?php 
			require_once 'functions_dbconnect.php';
			require_once 'functions.php';
			require_once 'functions_layout.php';
			
			db_connect();
			display_header();
			display_menu();
			
			if ( !empty($_POST['personcode']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) )
			{
				$personcode = get_post('personcode');
				$firstname = get_post('firstname');
                $lastname = get_post('lastname');
				$accountid = $_SESSION['accountid'];
				$query = "INSERT INTO fmplus.fmp_person (person_code, first_name, last_name, account_id) VALUES " .
						"('$personcode', '$firstname', '$lastname', '$accountid')";
				echo "Person added";
				mysql_query($query);
			}
			echo <<<END
			<form action="createperson.php" method="post">
			<p>Person Code: <input type="text" name="personcode"></p>
			<p>First Name: <input type="text" name="firstname"></p>
			<p>Last Name: <input type="text" name="lastname"></p>
			<p><input type="reset"/><input type="submit"/>
			</form>
END;
			display_footer();
			mysql_close();
		?>



	</body>
</html>