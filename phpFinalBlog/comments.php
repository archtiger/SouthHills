<?php

session_start();
//places the post that the user is currently on in their session superglobal array
if(!empty($_GET[post])){

        $_SESSION[post] = $_GET[post];

}
//stores the user;s position within the website structure
$_SESSION[pos] = "comment";
//file paths
require "accountManagement.php";

require "globals/navbar.php";
//simple form to inform the user of various results
require "globals/output.php";
//redirects the user to the index page if the are not logged in
require "globals/redirect.php";
//sql queries
require "globals/queries.php";

navbar();

echo "<table align = 'center' border = '1' width = '800'>";
//runs a query to retireve the content on the current post the user is viewing
$result = mysqli_query($connection,$listPostContent);
//checks if the query succeeded
if(!$result){
	//failed to retrieve data
	echo "<tr><td>The query used to retrieve the post's contents failed.</td></tr>";
//checks to ensure that data was retrieved from the database
}else if(mysqli_num_rows($result) < 1){

	echo "<tr><td>The post was not found</td></tr>";
//successfully received post data
}else{

	$row = mysqli_fetch_assoc($result);
	echo "<tr><td>";
	echo "<table>";
	echo "<tr><td><h3>$row[post_title]</h3></td></tr>";
	echo "<tr><td>Posted by: $row[username]</td></tr>";
	echo "<tr><td>Posted on: $row[time_stamp]</td></tr>";
	echo "<tr><td>$row[content]</td></tr>";
	echo "</table>";
	echo "</td><tr>";
}	

//runs query to retrieve any comments associated with this post
$result = mysqli_query($connection,$listComments);
//checks if the query succeeded
if(!$result){

        echo "<tr><td>Failed to retrieve user comments from the database. Please try again later</td></tr>";
//checks to see if data was retrieved by the query
}else if(mysqli_num_rows($result)<1){

        echo "<tr><td>No comments have been submitted for this post.</td></tr>";
//successfully received any comments associated with the post
}else{

		//displays comments
        while($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>";
		echo "<table>";
                echo "<tr><td><strong>$row[username]</strong></td></tr>";
                echo "<tr><td>$row[time_stamp]</td></tr>";
                echo "<tr><td>$row[content]</td></tr>";
		//bestows edit and delete capabilities to the user if they are the user that created the comment or are an admin
		if($_SESSION[username] == $row[username] || $_SESSION[admin] == 1){

                        echo "<tr><td><form style='display: inline' action = 'editDelete/editCommentForm.php?PHPSESSID=".session_id()."&comment=$row[ID]' method = 'POST'><input type = 'submit' value = 'Edit'></form>";
                        echo "<form style='display: inline' action = 'editDelete/deleteCommentForm.php?PHPSESSID=".session_id()."&comment=$row[ID]' method = 'POST'><input type = 'submit' value = 'Delete'></form></td></tr>";
                }
                echo "</table></td></tr>";
        }
}

echo "</table>";

?>
