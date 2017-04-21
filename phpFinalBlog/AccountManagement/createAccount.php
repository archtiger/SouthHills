<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//informs the user of outcomes
require "../globals/output.php";
//redirects the user to the index page if they aren't logged in
require "../globals/redirect.php";
//encrypts password
$_POST[password] = md5($_POST[password]);

require "../globals/queries.php";


//forces the user to utilize the interface for the website and prevent unnecessary query execution
if(!empty($_POST[username])){
	//verifies that the username entered by the user isn't already in use
	$result = mysqli_query($connection,$accountVerify);
	//checks if the query succeeded or not
	if(!$result){
		output("Account validation query failed",$GLOBALS[button],$GLOBALS[href]);
	//checks if any data was returned by the query. if no data is returned, the new account is created
	}else if(mysqli_num_rows($result)<1){
		//attempts create the new account
		if(!mysqli_query($connection,$createAccount)){
	
			output("Failed to create account",$GLOBALS[button],$GLOBALS[href]);

		}else{
			//loads initial info in their session variables and redirects the user to the topics listing page
			$_SESSION['username'] = $_POST['username'];	
			$_SESSION['admin'] = 0;
			header('Location: ../topics.php?PHPSESSID='.session_id());
		}
	}else{
		output("That username has already been taken",$GLOBALS[button],$GLOBALS[href]);
	}
}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$GLOBALS[button],$GLOBALS[href]);
}

?>

