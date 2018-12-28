<?php
	$query="SELECT * FROM `Ads`";
	$result = $DB1->fetchdata($query);

	for($c=0; $c < count($result); $c++)
	{
		print "
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Ad Owner: </td><td valign=\"top\"><input type=\"text\" name=\"AdOwner\" value=\"" . $result[$c]['AdOwner'] . "\">
				<td valign=\"top\">Website: </td><td valign=\"top\"><input type=\"text\" name=\"Website\" value=\"" . $result[$c]['Website'] . "\">
				<td valign=\"top\">Image: </td><td valign=\"top\"><img width=\"150\" src=\"." . $result[$c]['ImageLocation'] . "\" alt=\"" . $result[$c]['AdOwner'] . "\"><input id=\"browse\" type=\"file\" Name=\"ImageLocation\">
				<td valign=\"top\">Enabled: </td><td valign=\"top\"><input type=\"checkbox\" name=\"Enabled\" value=\"1\"";
				
				if($result[$c]['Enabled'] == 1)
					print " checked";
				
				print ">
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"Adverts\">
	</form>";
	}
?>
<br><br>

<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<table>
    	<tr>
        	<td valign="top">Ad Owner: </td><td valign="top"><input type="text" name="AdOwner"></td>
            <td valign="top">Website: </td><td valign="top"><input type="text" name="Website"></td>
            <td valign="top"><input type="file" name="ImageLocation"></td>
            <td valign="top">Enabled: </td><td valign="top"><input type="checkbox" name="Enabled" value="1"></td>
            
            <td valign="top"><button type="submit" name="actions" value="Adverts">Add Ad</button></td>
        </tr>
	</table>
    
    <input type="hidden" name="update" value="AddAd">
</form>
<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<button type="submit" name="actions" value="">Back</button>
</form>
