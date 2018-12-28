<?php
	$query = "select count(`Index1`) as num_rows from `news`";
	$result = $DB1->fetchdata($query);
	
	$TotalRows = $result[0]['num_rows'];
	
	if(isset($_POST['offset']))
		$offset = $_POST['offset'];
	else
		$offset = 0;
	
	$CurrentIndex = $offset;
	$Range = 10 * ($offset + 1);	
	$offset = 10 * $offset;
	
	if($offset == 0)
		$query = "SELECT * FROM `News` ORDER BY `Index1` DESC LIMIT 10;";
	else
	{
		$offset = $offset -0;
		$query = "SELECT * FROM `News` ORDER BY `Index1` DESC LIMIT 10 OFFSET " . $offset . ";";
	}
	
	$result = $DB1->fetchdata($query);

	for($c=0; $c < count($result); $c++)
	{
		print "
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td valign=\"top\">Title: </td><td valign=\"top\"><input type=\"text\" name=\"Title\" value=\"" . $result[$c]['Title'] . "\">
				<td valign=\"top\">Story: </td><td><textarea  name=\"Summary\" cols=\"80\" rows=\"7\">" . $result[$c]['Summary'] . "</textarea></td>
				<td valign=\"top\">Image: </td><td valign=\"top\">";
				
				if($result[$c]['ImageLocation'] != NULL)
					print "<img width=\"150\" src=\"" . $result[$c]['ImageLocation'] . "\">";
				else
					print "<img width=\"150\" src=\"./Images/NoImage.gif\">";
				
				print "</td><td valign=\"top\"><input type=\"file\" Name=\"ImageLocation\"></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td valign=\"top\"><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"News\">
	</form>";
	}
?>
<br><br>

<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<table>
    	<tr>
        	<td valign="top">Title: </td><td valign="top"><input type="text" name="Title">
            <td valign="top">Story: </td><td><textarea  name="Summary" cols="80" rows="7"></textarea></td>
            <td valign="top"><input type="file" name="ImageLocation"></td>

            <td valign="top"><button type="submit" name="actions" value="News">Add News</button></td>
        </tr>
	</table>
    
    <input type="hidden" name="update" value="AddNews">
</form>
<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post" name="form2">
	<button type="button" onclick="document.form2.submit();">Back</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
    if($offset > 0)
	{
		print "&nbsp; <input type=\"button\" onClick=\"document.form2.offset.value='" . ($CurrentIndex - 1) . "'; document.form2.actions.value='News'; form2.submit();\" value=\"<Previous\">";
		//print "<a style=\"color: #000000;\" href=\"./index.php?page=Archives&index=" . ($CurrentIndex - 1) . "\">< Previous</a> &nbsp;";
	}
	
	if($Range < $TotalRows)
	{
		print "&nbsp; <input type=\"button\" onClick=\"document.form2.offset.value='" . ($CurrentIndex + 1) . "'; document.form2.actions.value='News'; form2.submit();\" value=\"Next >\">";
	//	print "&nbsp; <a style=\"color: #000000;\" href=\"./index.php?page=Archives&index=" . ($CurrentIndex + 1) . "\">Next ></a>";
	}
?>
	<input type="hidden" name="actions" value="">
	<input type="hidden" name="offset" value="0">
</form>
