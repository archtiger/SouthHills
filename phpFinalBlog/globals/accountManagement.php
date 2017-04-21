<?php
//used to store file paths to be used throughout the site

$sessID = session_id();

$GLOBALS[styles] = "../styles.css";

$GLOBALS[button] = "Return to Account Management";

$GLOBALS[href] = "../?PHPSESSID=".sessID;

$GLOBALS[topicForm] = "../topicForm.php?PHPSESSID=".sessID;

$GLOBALS[postForm] = "../postForm.php?PHPSESSID=".sessID;

$GLOBALS[commentForm] = "../commentForm.php?PHPSESSID=".sessID;

$GLOBALS[topic] = "../topics.php?PHPSESSID=".sessID;

$GLOBALS[post] = "../posts.php?PHPSESSID=".sessID;

$GLOBALS[comment] = "../comments.php?PHPSESSID=".sessID;

?>
