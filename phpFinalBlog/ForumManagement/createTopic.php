<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform the user of various outcomes
require "../globals/output.php";
//redirects the user to the index page if they are not logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//button text
$button = "Return to Topic Form";

//prevents query execution when the user navigates to the page through the url

if(!empty($_POST[topicTitle])){
	//runs query to verify there is not already a topic with the same title
	$result = mysqli_query($connection,$topicVerify);
	//determines if the query failed or not
	if(!$result){
		output("Topic title verification query failed",$button,$GLOBALS[topicForm]);
	}else if(mysqli_num_rows($result)<1){
		//runs query to insert the topic into the database
		if(mysqli_query($connection,$createTopic)){

        		output("Topic submission successful",$button,$GLOBALS[topicForm]);
		}else{

        		output("Failed to create topic. Please try again later.",$button,$GLOBALS[topicForm]);
		}
	}else{
		output("Another topic already exists with that title",$button,$GLOBALS[topicForm]);
	}

}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[topicForm]);
}
?>
