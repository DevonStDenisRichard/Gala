<?php
	$query="SELECT DISTINCT `Volume`, `Issue` FROM `articles` ORDER BY `Volume` Desc, `Issue` DESC ";
	$result = $DB1->fetchdata($query);
	
	
	print "<form action=\"./Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
			<select name=\"Volume1\">";
	
	for($c = 0; $c < count($result); $c++)
	{
		print "<option value=\"Volume: " . $result[$c]['Volume'] . ", Issue: " .  $result[$c]['Issue'] . "\"";
	   
		if(isset($_POST['Volume']) && $_POST['Volume'] == "Volume: " . $result[$c]['Volume'] . ", Issue: " .  $result[$c]['Issue'])
			print " selected";
	   
		print ">Volume: " . $result[$c]['Volume'] . ", Issue: " .  $result[$c]['Issue'] . "</option><br>";
	}
	
	print "</select>
	
		<button type=\"submit\" name=\"actions\" value=\"Issues\">Switch to Volume/Issue</button>
	 </form>";

 if(isset($_POST['Volume1']))
 {	
	$Parts = explode(":", $_POST['Volume1']);
	$Vol = explode(",", $Parts[1]);
	$Vol = trim($Vol[0]);
	$Iss = trim($Parts[2]);


	$query = "SELECT * FROM `articles` WHERE `Volume` LIKE '" . $Vol . "' AND `Issue` LIKE '" . $Iss . "'";
	$result = $DB1->fetchdata($query);

	for($c=0; $c < count($result); $c++)
	{
		print "<br>
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Volume: </td><td valign=\"top\"><input type=\"text\" name=\"Volume\" value=\"" . $result[$c]['Volume'] . "\">
				<td valign=\"top\">Issue: </td><td valign=\"top\"><input type=\"text\" name=\"Issue\" value=\"" . $result[$c]['Issue'] . "\">
				<td valign=\"top\">PDF: </td><td valign=\"top\"><input type=\"file\" Name=\"PhysicalLocation\">
				<td valign=\"top\">Title: </td><td valign=\"top\"><input type=\"text\" name=\"Title\" value=\"" . $result[$c]['Title'] . "\">
				<td valign=\"top\">Article: </td><td valign=\"top\"><textarea  name=\"Article\" cols=\"80\" rows=\"7\">" . $result[$c]['Article'] . "</textarea></td>

				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"Issues\">
		<input type=\"hidden\" name=\"Volume1\" value=\"" . $_POST['Volume1'] . "\">
	</form>";
	}

	print "
	<br><br>
	
	<form action=\"./Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Volume: </td><td valign=\"top\"><input type=\"text\" name=\"Volume\">
				<td valign=\"top\">Issue: </td><td valign=\"top\"><input type=\"text\" name=\"Issue\">
				<td valign=\"top\">PDF: </td><td valign=\"top\"><input type=\"file\" Name=\"PhysicalLocation\">
				<td valign=\"top\">Title: </td><td valign=\"top\"><input type=\"text\" name=\"Title\">
				<td valign=\"top\">Article: </td><td valign=\"top\"><textarea  name=\"Article\" cols=\"80\" rows=\"7\"></textarea></td>
				
				<td valign=\"top\"><button type=\"submit\" name=\"actions\" value=\"Issues\">Add Article</button></td>
			</tr>
		</table>
		
		<input type=\"hidden\" name=\"Volume1\" value=\"" . $_POST['Volume1'] . "\">
		<input type=\"hidden\" name=\"update\" value=\"AddArticle\">
	</form>";
 }
?>

<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<button type="submit" name="actions" value="">Back</button>
</form>