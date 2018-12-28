<?php
	$query="SELECT * FROM `staticmenu`";
	$result = $DB1->fetchdata($query);

	for($c=0; $c < count($result); $c++)
	{
		print "
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Menu: </td><td valign=\"top\"><input type=\"text\" name=\"MenuName\" value=\"" . $result[$c]['MenuName'] . "\">
				<td valign=\"top\">Page Content: </td><td><textarea  name=\"Content\" cols=\"80\" rows=\"7\">" . $result[$c]['Content'] . "</textarea></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"Menus\">
	</form>";
	}
?>
<br><br>

<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<table>
    	<tr>
        	<td valign="top">Menu: </td><td valign="top"><input type="text" name="MenuName"></td>
            <td valign="top">Page Content: </td><td><textarea name="Content" cols="80" rows="7"></textarea></td>
          
            <td valign="top"><button type="submit" name="actions" value="Menus">Add Menu Item</button></td>
        </tr>
	</table>
    
    <input type="hidden" name="update" value="AddMenu">
</form>
<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<button type="submit" name="actions" value="">Back</button>
</form>