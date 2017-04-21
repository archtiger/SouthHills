<?php
session_start();
//file paths
require "accountManagement.php";

require "globals/navbar.php";
//form used to inform the user of various conditions
require "globals/output.php";
//redirects the user to the index page if they are not logged in
require "globals/redirect.php";

navbar();
//action for the form to take once submitted
$action = "ForumManagement/createPost.php?PHPSESSID=".session_id();
//header text
$header = "Create New Post";
//button text
$button = "Create Post";
//dynamic form template
require "ForumManagement/postFormT.php";
?>
