<?php

session_start();
//places the selected post in the session superglobal

if(!empty($_GET[post])){

        $_SESSION[post] = $_GET[post];

}
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form that informs user of outcomes
require "../globals/output.php";
//redirects user to index page if they are not logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//retrieves post content
$result = mysqli_query($connection,$listPostContent);
if(!$result){

        output("Failed to retrieve the post's content","Return to post listings",$GLOBALS[post]);
        die();
}else{
        $row = mysqli_fetch_assoc($result);
        $content = $row[content];
}

navbar();
//form action
$action = "editPostScript.php?PHPSESSID=".session_id();
//header text
$header = "Edit Post";
//button text
$button = "Save Post Revisions";
//post title
$title = $_SESSION[post];
//post form template
require "../ForumManagement/postFormT.php";
?>
