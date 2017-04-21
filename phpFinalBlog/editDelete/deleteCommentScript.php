<?php

session_start();
//fiel paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//informs th euser of various outcomes
require "../globals/output.php";
//redirects user to the index page if they are not logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//button text
$button = "Return to Comment Listings";
//prevents query execution when the user navigates to the page through the url
if(!empty($_POST[decision])){
		//runs query to delete the comment and detemrines if it succeeded or not
        if(mysqli_query($connection,$deleteCommentByID)){

                output("The comment has been successfully deleted",$button,$GLOBALS[comment]);
        }else{
                output("Failed to delete the comment",$button,$GLOBALS[comment]);
        }
}else{
        output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[comment]);
}

?>
