<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//informs the user of outcomes
require "../globals/output.php";
//redirects the user to the index page if they aren't logged in
require "../globals/redirect.php";
//prevents the user from navigating to the page via the url
if(!empty($_POST[logout])){
		//logs the user out by destroying their session and redirects them to the index page
		$_SESSION = array();

		session_destroy();

		output("Logout successful",$GLOBALS[button],$GLOBALS[href]);
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$GLOBALS[button],$GLOBALS[href]);
}

?>
