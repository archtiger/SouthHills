<?php
//simple form used to inform the user of various outcomes and redirect them to the specified page
function output($message,$button,$href){
	
	navbar();
	echo "<table border = '1' align = 'center'>";
	echo "<tr><td>".$message."</td></tr>";
	echo "<tr><td>";
	echo "<form action = '".$href."' method = 'POST'>";
	echo "<input type = 'submit' value = '".$button."'></form></td></tr>";
	echo "</table>";
}

?>
