<!DOCTYPE html>
<html>
	<head>
		<title>FM Plus - Create new building</title>
		<link rel='stylesheet' type='text/css' href='styles.css' />
        <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php 
			require_once 'functions_dbconnect.php';
			require_once'functions.php';
			require_once 'functions_layout.php';
			
			db_connect();
			display_header();
			display_menu();
			
			if ( !empty($_POST['buildingcode']) && !empty($_POST['buildingname']))
			{
				$buildingcode = get_post('buildingcode');
				$buildingname = get_post('buildingname');
				$accountid = $_SESSION['accountid'];
				$query = "INSERT INTO fmplus.fmp_building (building_code, building_name, account_id) VALUES " .
						"('$buildingcode', '$buildingname', '$accountid')";
				echo "Building added";
				mysql_query($query);
			}
			echo <<<END
			<form action="createbuilding.php" method="post">
			<p>Building Code: <input type="text" name="buildingcode"></p>
			<p>Building Name: <input type="text" name="buildingname"></p>
			<p><input type="reset"/><input type="submit"/>
			</form>
END;
			display_footer();
			mysql_close();
		?>



	</body>
</html>