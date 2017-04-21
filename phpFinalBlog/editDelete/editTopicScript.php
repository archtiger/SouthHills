<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform user of outcomes
require "../globals/output.php";
//redirects the user to the index page if they aren't logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//button text
$button = "Return to Topic Listings";
//prevents query execution when the user navigates to the page through the url
if(!empty($_POST[topicTitle])){
	//makes sure the new topic title doesn't match the original
	if($_SESSION[topic] != $_POST[topicTitle]){

		if(mysqli_autocommit($connection,FALSE)){
			//updates the foreign key in the posts table so that it will reference the new name of the topic
			if(mysqli_query($connection,$updatePostTopicTitle)){
				//updates the name of the topic
				if(mysqli_query($connection,"$editTopic")){

					mysqli_commit($connection);

					output("The changes to the topic have been saved",$button,$GLOBALS[topic]);

				}else{
					mysqli_rollback($connection);
					output("Failed to update the topic title",$button,$GLOBALS[topic]);
				}
			}else{
				mysqli_rollback($connection);
				output("Failed to update the related posts",$button,$GLOBALS[topic]);
			}
	
		}else{
			output("failed to create transaction",$button,$GLOBALS[topic]);
		}
	}else{
		output("The submitted topic title matches the original",$button,$GLOBALS[topic]);
	}
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[topic]);
}
?>
