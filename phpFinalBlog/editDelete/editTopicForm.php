<?php
session_start();
//places the topic the user is currently on the the seesion super global
if(!empty($_GET[topic])){

        $_SESSION[topic] = $_GET[topic];

}
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform user of outcomes
require "../globals/output.php";
//redirect user to index page if they are not logged in
require "../globals/redirect.php";

navbar();
//form action
$action = "editTopicScript.php?PHPSESSID=".session_id();
//header text
$header = "Edit Topic";
//button text
$button = "Save Topic Revisions";
//topic title
$title = $_SESSION[topic];
//topic form template
require "../ForumManagement/topicFormT.php";
?>
