<?php
session_start();
//places the current post in the seesion superglobal
if(!empty($_GET[post])){

        $_SESSION[post] = $_GET[post];

}
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform user of various outcomes
require "../globals/output.php";
//redirect user to index page if they aren't logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//retrieves data pertaining to the selected post
$result = mysqli_query($connection,$listPostContent);
if(!$result){

	output("Failed to retrieve the post's content","Return to post listings",$GLOBALS[post]);
        die();
}else{
 	$row = mysqli_fetch_assoc($result);
}

navbar();
//asks the user if they're sure they want to delete the post
?>

<table align = 'center' border = '1' width = '800'>
	<tr>
		<td align = 'center' colspan = '2'><h2>Are you sure you want to delete this post?</h2></td>
	</tr>

	<tr>
		<td colspan = '2'>
			<table>
				<tr>
<?php
echo					"<td'><h3>$row[post_title]</h3></td>";
echo				"</tr><tr>";
echo					"<td>$row[username]</td>";
echo				"</tr><tr>";
echo					"<td>$row[time_stamp]</td>";
echo				"</tr><tr>";
echo					"<td>$row[content]</td>";
echo				"</tr>";
?>
			</table>
		</td>
	</tr>

	<tr>
<?php
echo		"<td><form style = 'display: inline' action = 'deletePostScript.php?PHPSESSID=".session_id()."' method = 'POST'><input name = 'decision' type = 'submit' value = 'Yes'></form></td>";
echo		"<td><form style = 'display: inline' action = '$GLOBALS[post]' method = 'POST'><input type = 'submit' name = 'decision' value = 'No'></form></td>";
?>
	</tr>
</table>



