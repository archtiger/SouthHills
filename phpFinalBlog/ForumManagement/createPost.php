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
$button = "Return to Post Form";

//prevents query execution when the user navigates to the page through the url
if(!empty($_POST[postTitle])){
	//runs a query to determine whether there is already a post with the same name
	$result = mysqli_query($connection,$postVerify);
	//determines if the query failed or not
	if(!$result){

		output("Post title verification query failed",$button,$GLOBALS[postForm]);
	}else if(mysqli_num_rows($result)<1){
		//runs query to insert the post into the database
		if(mysqli_query($connection,$createPost)){

       			output("Post submission successful",$button,$GLOBALS[postForm]);
		}else{

   		   	output("Failed to submit post. Please try again later.",$button,$GLOBALS[postForm]);
		}
	}else{
		output("Another post is using that title",$button,$GLOBALS[postForm]);
	}
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[postForm]);
}
?>
