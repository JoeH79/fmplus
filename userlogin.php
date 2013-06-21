<!DOCTYPE html>
<html>
	<head>
		<title>FM Plus | Login</title>
		<link rel='stylesheet' type='text/css' href='styles.css' />
        <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php 
		include 'functions_dbconnect.php';
		include 'functions.php';
		include 'functions_security.php';
		include 'functions_layout.php';


        db_connect();

		
		if( !empty($_POST['username']) && !empty($_POST['password']) )
		{
			$username = get_post('username');
			$password = get_post('password');
			$salt = get_user_salt($username);
			$password_hash = hash_password($salt,$password);

			$query = "SELECT active_flag FROM fmplus.fmp_user WHERE user_name = '$username' AND user_password = '$password_hash'";

			$result = mysql_query($query);
			$rows = mysql_num_rows($result);

            display_header();
            display_menu();
			
			if ($rows == 0)
			{
				echo "<br><p>Username/password combination not recognised</p>";
				display_login_form();
				
			}  
			else if ($rows > 1)
			{
				echo "<br><p>There was a problem retrieving your details. If this problem persists, please contact the administrator.</p>";
			} 
			else
			{
				$userstatus = mysql_result($result, 0, 'active_flag');
				if ($userstatus !=1)
				{
					echo "Your account has been inactivated. Please contact your administrator if you think this is wrong.";
				}
				else
				{
					set_session($username);
					echo "Logged in.";
				}
			}
		} 
		else
		{
            display_header();
            display_menu();

			echo "<br><p>Please enter a username AND password!";
			display_login_form();
		} 
			
		display_footer();
		mysql_close();
		?>	


	</body>
</html>