<?php

session_start();
//file paths
require "accountManagement.php";

require "globals/navbar.php";
//form for informing the user of various outcomes
require "globals/output.php";
//redirects user to index page if they aren;t logged in
require "globals/redirect.php";

navbar();
//action the form will take once submitted
$action = "ForumManagement/createTopic.php?PHPSESSID=".session_id();
//header text
$header = "Create New Topic";
//button text
$button = "Create Topic";
//dynamic form template
require "ForumManagement/topicFormT.php";
?>
