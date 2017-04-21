<?php

session_start();
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//iforms the user of various outcomes
require "../globals/output.php";
//redirects the user to the index page if they aren't logged in
require "../globals/redirect.php";
//encrypts password
$_POST[password] = md5($_POST[password]);
//sql queries
require "../globals/queries.php";

//prevents login query from being executed if the user attempts to access the page directly through the url
if(!empty($_POST[username])){
	//vrerfies the entered account credentials against those in the dataabse
	$result = mysqli_query($connection,$login);
	//checks if the query succeeded
	if(!$result){

		output("The login query failed. Please try again later",$GLOBALS[button],$GLOBALS[href]);
	//checks if data was returned. if no data is returned, the login failed
	}else if(mysqli_num_rows($result) < 1){

		output("Login Failed. Incorrect username or password",$GLOBALS[button],$GLOBALS[href]);
	//success
	}else{
		$row = mysqli_fetch_assoc($result);	
		//inputs retrieved data into session variable
		$_SESSION['username'] = $row['username'];
		$_SESSION['admin'] = $row['admin'];
		
		/redirects user to the topics listing page
		header('Location: ../topics.php?PHPSESSID='.session_id());
	}

}else{
	output("Utilize the website's interface! I made the bloody thing for a reason!",$GLOBALS[button],$GLOBALS[href]);
}

?>
