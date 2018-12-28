

<?php
print "<form action=\"./Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
	<input type=\"date\" name=\"Date1\"";
	
	if(isset($_POST['Date1']))
		print " value=\"" . $_POST['Date1'] . "\"";
	
	print "\"><button type=\"submit\" name=\"actions\" value=\"Calendar\">Switch to Day</button>
 </form>";
 
 if(isset($_POST['Date1']))
 {
 	$query="SELECT * FROM `calendar` WHERE `Date1` = '" . $_POST['Date1'] . "'";
	$result = $DB1->fetchdata($query);
	
	
	for($c=0; $c < count($result); $c++)
	{
		print "
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Time: </td><td valign=\"top\"><input type=\"time\" name=\"Time1\" value=\"" . $result[$c]['Time1'] . "\">
				<td valign=\"top\">Event Title: </td><td valign=\"top\"><input type=\"text\" name=\"EventTitle\" value=\"" . $result[$c]['EventTitle'] . "\">
				<td valign=\"top\">Summary: </td><td><textarea  name=\"Summary\" cols=\"80\" rows=\"7\">" . $result[$c]['Summary'] . "</textarea></td>
				<td valign=\"top\">Meeting: </td><td valign=\"top\"><input type=\"checkbox\" name=\"Meeting\" value=\"1\"";
				
				if($result[$c]['Meeting'] == 1)
					print " checked";
				
				print ">
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"Date1\" value=\"" . $result[$c]['Date1'] . "\">
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"Calendar\">
	</form>";
	}
	
	
 print "<br><br><form action=\"./Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Time: </td><td valign=\"top\"><input type=\"time\" name=\"Time1\"></td>
				<td valign=\"top\">Event Title: </td><td valign=\"top\"><input type=\"text\" name=\"EventTitle\"></td>
				<td valign=\"top\">Summary: </td><td valign=\"top\"><textarea name=\"Summary\" cols=\"80\" rows=\"7\"></textarea></td>
				<td valign=\"top\">Meeting: </td><td valign=\"top\"><input type=\"checkbox\" name=\"Enabled\" value=\"1\"></td>
				
				<td valign=\"top\"><button type=\"submit\" name=\"actions\" value=\"Calendar\">Add Event</button></td>
			</tr>
		</table>
	 <input type=\"hidden\" name=\"Date1\" value=\"" . $_POST['Date1'] . "\">
		<input type=\"hidden\" name=\"update\" value=\"AddCal\">
	</form>";
 }
 
?>


<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<button type="submit" name="actions" value="">Back</button>
</form>