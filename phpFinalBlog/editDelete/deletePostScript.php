<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform user of outcomes
require "../globals/output.php";
//redirect user to index page if they aren't logged in
require "../globals/redirect.php";
//queries
require "../globals/queries.php";
//button text
$button = "Return to Post Listings";
//prevents query execution when the user navigates to the page through the url
if(!empty($_POST[decision])){

                if(mysqli_autocommit($connection,FALSE)){
						//deletes any comments associated with the post
                        if(mysqli_query($connection,$deleteCommentsByPost)){
								//deletes the post itself
                                if(mysqli_query($connection,$deletePostByTitle)){

                                        mysqli_commit($connection);
                                        output("The post was deleted",$button,$GLOBALS[post]);
  
                                }else{
                                        mysqli_rollback($connection);
                                        output("Failed to delete the post",$button,$GLOBALS[post]);
                                }
                        }else{
                                mysqli_rollback($connection);
                                output("Failed to delete the related comments",$button,$GLOBALS[post]);
                        }

                }else{
                        output("failed to create transaction",$button,$GLOBALS[post]);
                }
        
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[post]);
}
?>
