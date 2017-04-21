<?php

//displays the current topic the user is on
function topic(){

	return ">><a href = '$GLOBALS[post]'>$_SESSION[topic]</a>";

}
//displays the current post the user is on
function post(){

	return ">><a href = '$GLOBALS[comment]'>$_SESSION[post]</a>";

}
//creates the navbar
function navbar(){

	echo "<table width = '800' align = 'center'>";
	//takes user back to the index page
	echo "<tr><td><a href = '$GLOBALS[href]'>Account Management</a></td></tr>";
	//displays the user's username
	echo "<tr><td>$_SESSION[username]</td></tr>";

	echo "<tr><td>";
	//displays a link back to the main topic page
	$forumPos = "<a href = '$GLOBALS[topic]'>Topics</a>";
	
	//if the user is on the topics page, displays link to allow them to create a new topic
	if($_SESSION[pos]=="topic"){

		$formLink = "<a href = '$GLOBALS[topicForm]'>Create New Topic</a>";
	}
	//if the user is on the posts page, displays link to allow them to create a new post and another link displaying the name of the topic the user is on
	if($_SESSION[pos]=="post"){

		$forumPos .= topic();
		$formLink = "<a href = '$GLOBALS[postForm]'>Create New Post</a>";
	}
	//if the user is on the comments page, displays link to allow them to create a new comment and two other links displaying the name of the post and topic the user is on
	if($_SESSION[pos]=="comment"){

		$forumPos .= topic();
		$formLink = "<a href = '$GLOBALS[commentForm]'>Create New Comment</a>";
		$forumPos .= post();

	}

	echo $forumPos."</td><td>".$formLink."</td></tr></table>";

	echo "<hr>";

}

?>
