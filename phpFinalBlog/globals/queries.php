<?php

//opens a connection to the database

$connection = mysqli_connect("localhost","jhall86","password","jhall86");

if(!$connection){

        output("Failed to connect to the database",$GLOBALS[button],$GLOBALS[href]);
	die();
}

//Account Management
$createAccount = "insert into logins (username,password,first_name,last_name,email) values('$_POST[username]','$_POST[password]','$_POST[firstName]','$_POST[lastName]','$_POST[email]')";

$login = "select username, password, admin from logins where '$_POST[username]' = username and '$_POST[password]' = password";

$deleteAccount = "delete from logins where '$_POST[username]' = username and '$_POST[password]' = password";

$accountVerify = "select username from logins where '$_POST[username]' = username";

//posting forum entries
$createComment = "insert into comments (time_stamp,post_title,username,content) values(Now(),'$_SESSION[post]','$_SESSION[username]','$_POST[content]')";

$createPost = "insert into posts values('$_POST[postTitle]','$_SESSION[topic]','$_SESSION[username]',Now(),'$_POST[content]')";

$createTopic = "insert into topics values('$_POST[topicTitle]','$_SESSION[username]',Now())";


//listing forum entries
$listTopics = "select * from topics";

$listPosts = "select post_title,username,time_stamp from posts where '$_SESSION[topic]' = topic_title";

$listComments = "select username,time_stamp,content,ID from comments where '$_SESSION[post]' = post_title";

$listPostContent = "select post_title,username,time_stamp,content from posts where '$_SESSION[post]' = post_title";


//forum entry verification to protect primary key integrity
$postVerify = "select post_title from posts where post_title = '$_POST[postTitle]'";

$topicVerify = "select topic_title from topics where topic_title = '$_POST[topicTitle]'";


//forum entry modification (delete)
$deleteCommentByID = "delete from comments where '$_SESSION[comment]' = ID";

$deletePostByTitle = "delete from posts where '$_SESSION[post]' = post_title";

$deleteCommentsByPost = "delete from comments where '$_SESSION[post]' = post_title";



//forum entry modification delete user account
$deleteCommentsByUser = "delete from comments where '$_POST[username]' = username";

$selectPostsByUser = "select post_title from posts where username = '$_POST[username]'";

$updateTopicUser = "update topics set username = 'anonymous' where username = '$_POST[username]'";

$deletePosts = "delete from posts where username = '$_POST[username]'";

function deleteCommentsByPost($postTitle){

	return "delete from comments where post_title = '$postTitle'";
}



//forum entry modification (edit)

$updateCommentPostTitle = "update comments set post_title = '$_POST[postTitle]' where post_title = '$_SESSION[post]'";

$updatePostTopicTitle = "update posts set topic_title = '$_POST[topicTitle]' where topic_title = '$_SESSION[topic]'"; 

$editTopic = "update topics set topic_title = '$_POST[topicTitle]', time_stamp = Now() where topic_title = '$_SESSION[topic]'";

$editPost = "update posts set post_title = '$_POST[postTitle]', content = '$_POST[content]',time_stamp = Now() where post_title = '$_SESSION[post]'";

$editComment = "update comments set content = '$_POST[content]', time_stamp = Now() where ID = '$_SESSION[comment]'";

$selectComment = "select content,username,time_stamp from comments where ID = '$_SESSION[comment]'";



?>
