<?php
session_start();

//contains formatting text for forms and paths to other pages
require "accountManagement.php";

require "globals/navbar.php";

//simple form used for displaying a message to the user and redirecting them to a specified page
require "globals/output.php";
//redirects the user to the index page if they are not logged in
require "globals/redirect.php";

navbar();
//the script that 
$action = "ForumManagement/createComment.php?PHPSESSID=".session_id();
//header text
$header = "Create New Comment";
//button text
$button = "Create Comment";

//brings in a form template that will incorporate the data specified in this file
require "ForumManagement/commentFormT.php";

?>
