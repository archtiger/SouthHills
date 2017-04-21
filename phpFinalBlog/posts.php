<?php

session_start();
//places the topic the user is currently on in the session super global
if(!empty($_GET[topic])){

	$_SESSION[topic] = $_GET[topic];

}
//set the user's position as post
$_SESSION[pos] = "post";
//file paths
require "accountManagement.php";

require "globals/navbar.php";
//form used for informing the user of certain outcomes
require "globals/output.php";
//redirects user to the index page if they are not logged in
require "globals/redirect.php";
//sql queries
require "globals/queries.php";

navbar();
//runs a query to retrieve the posts associated with the current topic
$result = mysqli_query($connection,$listPosts);

echo "<table align = 'center' border = '1' width = '800'>";
//checks if the query failed or not
if(!$result){

        echo "<tr><td>Failed to retrieve user posts from the database. Please try again later</td></tr>";
//checks if data was retrieved
}else if(mysqli_num_rows($result)<1){

        echo "<tr><td>No posts have been submitted for this topic.</td></tr>";
//data was successfully retrieved
}else{
		//displays the posts
        while($row = mysqli_fetch_assoc($result)){

			echo "<tr><td><table>";
					echo "<tr>";
					echo    "<td><a href = 'comments.php?PHPSESSID=".session_id()."&post=$row[post_title]'>$row[post_title]</a></td>";
					echo    "<td>Created on: $row[time_stamp]</td>";
					echo    "<td>Created by: $row[username]</td>";
					echo "</tr>";
			//allows the user to edit or delete posts if they are the user who created the post or if they are an admin
			if($_SESSION[username] == $row[username] || $_SESSION[admin] == 1){

							echo "<tr><td><form style='display: inline' action = 'editDelete/editPostForm.php?PHPSESSID=".session_id()."&post=$row[post_title]' method = 'POST'><input type = 'submit' value = 'Edit'></form>";
							echo "<form style='display: inline' action = 'editDelete/deletePostForm.php?PHPSESSID=".session_id()."&post=$row[post_title]' method = 'POST'><input type = 'submit' value = 'Delete'></form></td></tr>";
					}
			echo "</table></td></tr>";
        }
}

echo "</table>";

?>
