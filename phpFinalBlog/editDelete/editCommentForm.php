<?php
session_start();
//places the select comment in the session super global
if(!empty($_GET[comment])){

        $_SESSION[comment] = $_GET[comment];

}
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//informs user of outcomes
require "../globals/output.php";
//redirects user to index page if they aren't logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//retrieves the comment data
$result = mysqli_query($connection,$selectComment);

if(!$result){

        output("Failed to retrieve the comment's content","Return to comment listings",$GLOBALS[comment]);
        die();
}else{  
        $row = mysqli_fetch_assoc($result);
        $content = $row[content];
}

navbar();
//form action
$action = "editCommentScript.php?PHPSESSID=".session_id();
//header text
$header = "Edit Comment";
//button text
$button = "Save Comment Revisions";
//comment form
require "../ForumManagement/commentFormT.php";
?>
