<?php
	$query="SELECT * FROM `minutes`";
	$result = $DB1->fetchdata($query);

	for($c=0; $c < count($result); $c++)
	{
		print "
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Title: </td><td valign=\"top\"><input type=\"text\" name=\"Title\" value=\"" . $result[$c]['Title'] . "\">
				<td valign=\"top\">PDF: </td><td valign=\"top\"><input id=\"browse\" type=\"file\" Name=\"PhysicalLocation\"></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"Minutes\">
	</form>";
	}
?>
<br><br>

<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<table>
    	<tr>
        	<td valign="top">Title: </td><td valign="top"><input type="text" name="Title"></td>
            <td valign="top">PDF: </td><td valign="top"><input type="file" name="PhysicalLocation"></td>
            <td valign="top"><button type="submit" name="actions" value="Minutes">Add Minutes</button></td>
        </tr>
	</table>
    
    <input type="hidden" name="update" value="AddMinutes">
</form>
<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<button type="submit" name="actions" value="">Back</button>
</form>
