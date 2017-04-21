<?php

session_start();
//sets the location of the user in the session super global
$_SESSION[pos]="account";
//file paths
require "accountManagement.php";

require "globals/navbar.php";

navbar();


?>

<!--serves as the account management screen-->

<link href='styles.css' rel='stylesheet' type='text/css' />

<table align = 'center' border = '1' width = '800'>

	<tr><th colspan = '2'><h2>Account Management</h2></th></tr>
<?php
echo "<form action = 'AccountManagement/login.php?PHPSESSID=".session_id()."' method = 'POST'>";
?>
		<tr><th colspan = '2'><h3>Login</h3></th></tr>
		<tr>
			<td>Username</td>
			<td><input type = 'text' name = 'username' required></td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type = 'password' name = 'password' required></td>
		</tr>

		<tr>
			<td colspan = '2'><input type = 'submit' value = 'Login'></td>
		</tr>
	</form>
<?php
echo	"<form action = 'AccountManagement/logout.php?PHPSESSID=".session_id()."' method = 'POST'>";
?>
		<tr><th colspan = '2'><h3>Logout</h3></th></tr>

		<tr>	
			<td colspan = '2'><input name = 'logout' type = 'submit' value = 'logout'></td>
		</tr>
	</form>
<?php
echo	"<form action = 'AccountManagement/createAccount.php?PHPSESSID=".session_id()."' method = 'POST'>";
?>
		<tr><th colspan = '2'><h3>Create Account</h3></th></tr>

		<tr>
			<td>Username</td>
			<td><input type = 'text' name = 'username' required></td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type = 'password' name = 'password' required></td>
		</tr>

		<tr>
			<td>First Name</td>
			<td><input type = 'text' name = 'firstName' required></td>
		</tr>

		<tr>
			<td>Last Name</td>
			<td><input type = 'text' name = 'lastName' required></td>
		</tr>

		<tr>
			<td>Email</td>
			<td><input type = 'email' name = 'email' required></td>
		</tr>

		<tr>
			<td colspan = '2'><input type = 'submit' value = 'Create Account'></td>
		</tr>

	</form>
<?php
echo	"<form action = 'AccountManagement/deleteAccount.php?PHPSESSID=".session_id()."' method = 'POST'>";
?>
		<tr><th colspan = '2'><h3>Delete Account</h3></th></tr>

		<tr>
			<td>Username</td>
			<td><input type = 'text' name = 'username' required></td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type = 'password' name = 'password' required></span></td>
		</tr>

		<tr>
			<td colspan = '2'><input type = 'submit' value = 'Delete Account'></td>
		</tr>

	</form>
	

</table>
