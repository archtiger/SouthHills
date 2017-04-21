<?php
session_start();
//places the comment the user wishes to delete in the session auto global
if(!empty($_GET[comment])){
	$_SESSION[comment] = $_GET[comment];
}
//file paths
require "../globals/accountManagement.php";

require "../globals/navbar.php";
//form to inform the user of various outcomes
require "../globals/output.php";
//redirects the user to the index page if they are not logged in
require "../globals/redirect.php";
//sql queries
require "../globals/queries.php";
//runs query to retrieve info pertaining to the comment id
$result = mysqli_query($connection,$selectComment);

//checks of query succeeded
if(!$result){

        output("Failed to retrieve the comment's content","Return to comment listings",$GLOBALS[comment]);
        die();
}else{
        $row = mysqli_fetch_assoc($result);
}

navbar();
//displays comment info and asks the user if they're sure they want ot delete the comment
?>

<table align = 'center' border = '1' width = '800'>
        <tr>
                <td colspan = '2' align = 'center'><h2>Are you sure you want to delete this comment?</h2></td>
        </tr>

        <tr>
                <td colspan = '2'>
                        <table>
                                <tr>
<?php
echo                                    "<td>$row[username]</td>";
echo                            "</tr><tr>";
echo                                    "<td>$row[time_stamp]</td>";
echo                            "</tr><tr>";
echo                                    "<td>$row[content]</td>";
echo                            "</tr>";
?>
                        </table>
                </td>
        </tr>

        <tr>
<?php
echo            "<td><form style = 'display: inline' action = 'deleteCommentScript.php?PHPSESSID=".session_id()."' method = 'POST'><input name = 'decision' type = 'submit' value = 'Yes'></form></td>";
echo            "<td><form style = 'display: inline' action = '$GLOBALS[comment]' method = 'POST'><input type = 'submit' name = 'decision' value = 'No'></form></td>";
?>
        </tr>
</table>
