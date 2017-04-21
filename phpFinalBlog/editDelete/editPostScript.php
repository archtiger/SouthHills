<?php
session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform user of outcomes
require "../globals/output.php";
//redirect user to index page if they are not logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//button text
$button = "Return to Post Listings";
//prevents query execution when the user navigates to the page through the url
if(!empty($_POST[postTitle])){

        if($_SESSION[post] != $_POST[postTitle]){

                if(mysqli_autocommit($connection,FALSE)){

						//updates the foreign key to the posts table to the comments table
                        if(mysqli_query($connection,$updateCommentPostTitle)){
								//updates the post
                                if(mysqli_query($connection,$editPost)){

                                        mysqli_commit($connection);

                                        output("The changes to the post have been saved",$button,$GLOBALS[post]);
          
                                }else{
                                        mysqli_rollback($connection);
                                        output("Failed to update the post",$button,$GLOBALS[post]);                                
								}
                        }else{      
                                mysqli_rollback($connection);
                                output("Failed to update the related comments",$button,$GLOBALS[post]);
                        }           
                            
                }else{
                        output("failed to create transaction",$button,$GLOBALS[post]);
                }           
        }else{      
                if(mysqli_query($connection,$editPost)){
					output("The changes to the post have been saved",$button,$GLOBALS[post]);
				}else{
					output("Failed to update the post",$button,$GLOBALS[post]);
				}
        }           
}else{      
        output("Utilize the website's interface! I made the bloody thing for a reason!",$button,$GLOBALS[post]);
}
?>

