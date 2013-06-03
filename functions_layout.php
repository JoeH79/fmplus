<?php


function display_header()
{
echo <<<END
	<div id="container">
		<div id="header">
			<span id="header-left">
				<span id="logo"><a href="fmplus.php">FM Plus</a></span>
			</span>
		<span id="header-right">
END;

if (isset($_COOKIE[session_name()]))
{
	session_start();
	$username = $_SESSION['username'];
    echo '<span id="logged-in-as">Logged in as '.$username.'</span>';
	echo '<span id="logout"><a href="userlogout.php">Logout</a></span>';
}
else
{
	echo '<span id="login"><a href="userlogin.php">Login</a></span>';
	echo '<span id="createaccount"><a href="createaccount.php">Create account</a></span>';
} 
echo "</span>";
echo "</div>";
}

function display_menu ()
{
echo <<<END
	<div id="menu">
	<ul id="menu-list">
	<li class="menu-item" id="menu-item-people"><a href="display_people.php">People</a></li>
	<li class="menu-item" id="menu-item-buildings"><a href="display_buildings.php">Buildings</a></li>
	<li class="menu-item" id="menu-item-floors">Floors</li>
	<li class="menu-item"  id="menu-item-rooms">Rooms</li>
	<li class="menu-item" id="menu-item-orgs">Organisations</li>
	<li class="menu-item" id="menu-item-reports">Reporting</li>
	</ul>
	</div>
END;
}

function display_footer()
{
echo <<<END
	<div id="bottom">
	<ul>
	<li class="menu-item-bottom">FAQ</li>
	<li class="menu-item-bottom">Contact</li>
	<li class="menu-item-bottom">Etc.</li>
	<li class="menu-item-bottom">Etc.</li>
	</ul>
	</div>
END;
}
