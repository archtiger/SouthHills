<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//informs user of outcomes
require "../globals/output.php";
//redirects user to index page if they aren't logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//button text
$button = "Return to Comment Listings";
//prevents query execution when the user navigates to the page through the url
if(!empty($_POST[content])){
	//updates the comments data
	if(mysqli_query($connection,$editComment)){

		output("The changes to the comment have been successfully saved",$button,$GLOBALS[comment]);
	}else{
		output("Failed to update the comment",$button,$GLOBALS[comment]);
	}
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[comment]);
}
		
?>
