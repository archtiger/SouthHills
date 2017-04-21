
<?php
//comment form template
echo "<form action = '$action' method = 'POST'>";
?>
<table align = 'center' width = '800' border = '1'>
<?php
echo        "<tr><th colspan = '2'><h2>$header</h2></th></tr>";
?>

        <tr>
                <td>Content</td>
<?php
echo            "<td><textarea cols = '120' rows = '10' name = 'content' required>$content</textarea></td>";
?>
        </tr>

        <tr>
<?php
echo             "<td colspan = '2'><input type = 'submit' value = '$button'></td>";
?>
        </tr>
</table>

</form>
