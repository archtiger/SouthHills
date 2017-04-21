<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//informs user of outcomes
require "../globals/output.php";
//redirects the user to the index page if they aren't logged in
require "../globals/redirect.php";
//encrypts password
$_POST[password] = md5($_POST[password]);
//sql queries
require "../globals/queries.php";

//prevent unecessary query execution if the user navigates to the page through the url
if(!empty($_POST[username])){
	//runs the login query to verify the user's account credentials
	$result = mysqli_query($connection,$login);
	//checks if the query succeeded or not
	if(!$result){
		output("Account credentials verification failed",$GLOBALS[button],$GLOBALS[href]);
	//if no data was returned, then the user is denied the ability to delete their account
	}else if(mysqli_num_rows($result)<1){
		output("Invalid account credentials",$GLOBALS[button],$GLOBALS[href]);
	//success
	}else{
		//returns associative array  from the returned data from the login query
		$row = mysqli_fetch_assoc($result);
		//ensures that the user can only delete their own account
		if($row[username] == $_SESSION[username]){

			if(mysqli_autocommit($connection,FALSE)){	
				//retrieves all the posts that th user created
				$result = mysqli_query($connection,$selectPostsByUser);
				//checks if query succeeded
				if(!$result){

					output("failed to retrieve posts",$GLOBALS[button],$GLOBALS[href]);
				/success
				}else{
					
					//deletes all comments associated with the user's post
					while($row = mysqli_fetch_assoc($result)){
						if(!mysqli_query($connection,deleteCommentsByPost($row[post_title]))){
							$fail = TRUE;
						}
						
					}
					//if no errors where encountered while destroying comments
					if(!$fail){
						//runs query to delete any posts made by the user
						if(mysqli_query($connection,$deletePosts)){
							//deletes any remaining comments made by the user
							if(mysqli_query($connection,$deleteCommentsByUser)){	
								//changes the username associated with any topics created by the user to 'anonymous'
								if(mysqli_query($connection,$updateTopicUser)){
									//deletes the user's account
									if(!mysqli_query($connection,$deleteAccount)){
										mysqli_rollback($connection);
										output("Failed to delete account",$GLOBALS[button],$GLOBALS[href]);

									}else{
										mysqli_commit($connection);
										$_SESSION = array();
										session_destroy();
										output("Account successfully deleted",$GLOBALS[button],$GLOBALS[href]);
									}
									
						
								}else{
									mysqli_rollback($connection);
									output("Failed to update user topics",$GLOBALS[button],$GLOBALS[href]);
								}

							}else{
								mysqli_rollback($connection);
								output("Failed to delete user comments",$GLOBALS[button],$GLOBALS[href]);
							}
		
						}else{	
							mysqli_rollback($connection);
							output("Failed to delete user posts",$GLOBALS[button],$GLOBALS[href]);
						}

					}else{
						mysqli_rollback($connection);
						output("Failed to delete the related comments to the user's posts",$GLOBALS[button],$GLOBALS[href]);
					}
				}

			}else{
				output("failed to initiate transaction",$GLOBALS[button],$GLOBALS[href]);
			}
		}else{
			output("You can't delete someone else's account",$GLOBALS[button],$GLOBALS[href]);
		}
	}
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$GLOBALS[button],$GLOBALS[href]);
}

?>
