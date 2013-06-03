<?php

function generate_salt() 
{
	$salt_size = 16;
	return mcrypt_create_iv($salt_size, MCRYPT_RAND);
}

function hash_password($salt,$password)
{
	return sha1($salt . $password);
}

function display_login_form()
{
echo <<<END
	<form action="userlogin.php" method="post">
		<p>Username: <input type="text" name="username"/></p>
		<p>Password: <input type="password" name="password"/></p>
		<p><input type="submit"/></p>
	</form>
END;
}

function log_out()
{
	session_start();
	$_SESSION = array();

	if (session_id() != "" || isset ($_COOKIE[session_name()]))
	{
		setcookie(session_name(), '', time()-2592000, '/');
	}
	session_destroy();
		
}	

function get_current_session_account()
{
	if(session_id()){
		return $_SESSION['accountid'];
	}
}

function user_exists($username)
{
	$escaped_username = mysql_real_escape_string($username);
	$query = 'SELECT * FROM fmp_user WHERE user_name = "$escaped_username"';
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if (!$rows > 0) { return false; }
	else {return true;} 
}

function get_user_salt($username)
{
	$escaped_username = mysql_real_escape_string($username);
	$query = "SELECT user_salt FROM fmp_user WHERE user_name = '$escaped_username'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	if ($rows == 1)
	{
		return mysql_result($result, 0, 'user_salt');
	}
}

function get_user_account_id($username)
{
	$escaped_username = mysql_real_escape_string($username);
	$query = "SELECT acc.account_id FROM fmp_account acc INNER JOIN fmp_user user ON acc.account_id = user.account_id WHERE user.user_name = '$escaped_username'";
	$result = mysql_query($query);
	return mysql_result($result, 0, 'acc.account_id');
}

function get_account_id($accountname)
{
	$escaped_accountname = mysql_real_escape_string($accountname);
	$query = "SELECT account_id FROM fmp_account WHERE account_name = '$escaped_accountname'";
	$result = mysql_query($query);

	return mysql_result($result, 0, 'account_id');
}

function set_session($username)
{
	session_start();
	$_SESSION['username']=$username;
	
	$query = "SELECT account_id FROM fmp_user WHERE user_name = '$username'";
	$result = mysql_query($query);
	$accountid = mysql_result($result, 0);
	$_SESSION['accountid']= $accountid;
}
?>