
<?php
//topic form template
echo "<form action = '$action' method = 'POST'>";
?>
<table align = 'center' border = '1' width = '800'>

<?php
echo	"<tr><th colspan = '2'><h2>$header</h2></th></tr>";
?>
	<tr>
		<td>Topic Title</td>
<?php
echo		"<td><input type = 'text' name = 'topicTitle' value = '$title' required></td>";
?>
	</tr>

	<tr>
<?php
echo		"<td colspan = '2'><input type = 'submit' value = '$button'></td>";
?>
	</tr>

</table>

</form>
