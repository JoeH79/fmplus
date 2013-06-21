<!DOCTYPE html>
<html>
	<head>
		<title>FM Plus | Create new account</title>
		<link rel='stylesheet' type='text/css' href='styles.css' />
        <link href='http://fonts.googleapis.com/css?family=Numans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
			require_once 'functions_dbconnect.php';
			require_once 'functions.php';
			require_once 'functions_security.php';
			require_once 'functions_layout.php';
	
			db_connect();
			display_header();
			if ( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) )
			{
				$username = get_post('username');
				$password = get_post('password');
				$accountname = get_post('accountname');
				$email = get_post('email');
				if (user_exists($username))
				{
					echo <<<END
					<form action="createaccount.php" method="post">
						<p>Account name: <input type="text" name="accountname"/></p>
						<p>Username: <input type="text" name="username"/> USERNAME $username ALREADY EXISTS</p>
						<p>Password: <input type="password" name="password" /><p>
						<p>Email: <input type="email" name="email"/><p>
						<p><input type="reset"/><input type="submit" />
					</form>
END;
				}
				else
				{
					
					$user_salt = generate_salt();
					$password_hash = hash_password($user_salt, $password);
					
					$account_insert_query = "INSERT INTO fmp_account (account_name) VALUES " . "('$accountname')";
					mysql_query($account_insert_query);
					
					$account_id = get_account_id($accountname);
					$user_insert_query = "INSERT INTO fmp_user (user_name, user_password, user_email, user_salt, account_id) VALUES " .
							"('$username', '$password_hash', '$email', '$user_salt', '$account_id')";
					mysql_query($user_insert_query);
					
					$user_id = get_user_account_id($username);
					$add_account_owner_id_query = "UPDATE fmp_account SET account_owner_id = '$user_id' WHERE account_id = '$account_id'";
					set_session($username);
					echo "User created";			
				}

			}
			else 
			{
				echo <<<END
					<form action="createaccount.php" method="post">
						<p>Account name: <input type="text" name="accountname"/></p>
						<p>Username: <input type="text" name="username"/></p>
						<p>Password: <input type="password" name="password" /><p>
						<p>Email: <input type="email" name="email"/><p>
						<p><input type="reset"/><input type="submit" />
					</form>
END;
			}
			
			display_footer();
			mysql_close();
		?>
		
	</body>
</html>