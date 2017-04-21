<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//alerts the user of various outcomes
require "../globals/output.php";
//redirects the user back to the index page if they aren't logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//button text
$button = "Return to Comment Form";

//prevents query execution if the page is reached through the url and not the interface
if(!empty($_POST[content])){
	//determines whether the query was successful or not
	if(mysqli_query($connection,$createComment)){

		output("Comment submission successful",$button,$GLOBALS[commentForm]);
	}else{

		output("Failed to submit comment. Please try again later.",$button,$GLOBALS[commentForm]);
	} 
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[commentForm]);
}
?>
