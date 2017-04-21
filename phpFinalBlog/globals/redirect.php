<?php
//redirects the user back to the index page if they are not logged in
if(!isset($_POST['username']) && !isset($_SESSION['username'])){
	
	output("You must be logged in to access this site",$GLOBALS[button],$GLOBALS[href]);
	die();
}

echo "<link href='$GLOBALS[styles]' rel='stylesheet' type='text/css' />";

?>
