<?php

/*global variables for use allowing the user to navigate to other pages
 and in providing text to a form button that sends the user back to the index page */


$sessID = session_id();

$GLOBALS[styles] = "styles.css";

$GLOBALS[button] = "Return to Account Management";

$GLOBALS[href] = "./?PHPSESSID=".$sessID;

$GLOBALS[topicForm] = "topicForm.php?PHPSESSID=".$sessID;

$GLOBALS[postForm] = "postForm.php?PHPSESSID=".$sessID;

$GLOBALS[commentForm] = "commentForm.php?PHPSESSID=".$sessID;

$GLOBALS[topic] = "topics.php?PHPSESSID=".$sessID;

$GLOBALS[post] = "posts.php?PHPSESSID=".$sessID;

$GLOBALS[comment] = "comments.php?PHPSESSID=".$sessID;

?>
