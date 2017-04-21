<?php

session_start();
//sets the user's position as topic
$_SESSION[pos] = "topic";
//file paths
require "accountManagement.php";

require "globals/navbar.php";
//form for informing the user of various outcomes
require "globals/output.php";
//redirects user to the index page if they aren't logged in
require "globals/redirect.php";
//sql queries
require "globals/queries.php";

navbar();
//runs query to retrieve any topics from the database
$result = mysqli_query($connection,$listTopics);

echo "<table align = 'center' border = '1' width = '800'>";
//checks if the query succeeded or not
if(!$result){

	echo "<tr><td>Failed to retrieve user topics from the database. Please try again later</td></tr>";
//checks if any data was retrieved by the query
}else if(mysqli_num_rows($result)<1){

	echo "<tr><td>No topics have been submitted</td></tr>";
//query was successful
}else{
	//displays topics
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>";
		echo "<table><tr>";
		echo 	"<td><a href = 'posts.php?PHPSESSID=".session_id()."&topic=$row[topic_title]'>$row[topic_title]</a></td>";
		echo	"<td>Created on: $row[time_stamp]</td>";
		echo	"<td>Created by: $row[username]</td>";
		echo "</tr>";
		

		//the obmission of a delete button for topics is intentional
		//allows the user that created the topic or admins to edit the topic
		if($_SESSION[username] == $row[username] || $_SESSION[admin] == 1){

               		echo "<tr><td><form style='display: inline' action = 'editDelete/editTopicForm.php?PHPSESSID=".session_id()."&topic=$row[topic_title]' method = 'POST'><input type = 'submit' value = 'Edit'></form>";
        
        	}
		echo "</table></td></tr>";	
	}
}

echo "</table>";

?>
