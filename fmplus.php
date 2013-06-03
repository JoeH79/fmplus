<!DOCTYPE html>
<html>
	<head>
		<title> FM Plus</title>
		<link rel='stylesheet' type='text/css' href='styles.css' />
        <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
	</head>
	<body>


		<?php
			include 'functions.php';
			include 'functions_dbconnect.php';
			include 'functions_layout.php';

			db_connect();
			ini_set('display_errors',1);
			error_reporting(E_ALL);

			display_header();
			display_menu();			
			
			display_footer();
			mysql_close();
		?>

	</body>
</html>