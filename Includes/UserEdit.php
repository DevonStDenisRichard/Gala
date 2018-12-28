<datalist id="Levels">
  <option value="Admin">
  <option value="Standard">
</datalist>	

<?php
	$query="SELECT * FROM `users`";
	$result = $DB1->fetchdata($query);

	for($c=0; $c < count($result); $c++)
	{
		print "
	<form action=\"Admin.php\" enctype=\"multipart/form-data\" method=\"post\">
		<table>
			<tr>
				<td>User: </td><td><input type=\"text\" name=\"User\" value=\"" . $result[$c]['User'] . "\">
				<td>Password</td><td><input type=\"password\" name=\"Pass\" value=\"" . $result[$c]['Pass'] . "\"</td>
				<td>Level</td><td><input list=\"Levels\" value=\"" . $result[$c]['Level'] . "\" name=\"Level\"></td>
				<td><button type=\"submit\" name=\"update\" value=\"update\">Update</button></td>
				<td><button type=\"submit\" name=\"update\" value=\"delete\">Delete</button></td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"index\" value=\"" . $result[$c]['Index1'] . "\">
		<input type=\"hidden\" name=\"actions\" value=\"Users\">
	</form>";
	}
?>
<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<table>
    	<tr>
        	<td>User: </td><td><input type="text" name="User"></td>
            <td>Password: </td><td><input type="password" name="Pass"></td>
            <td>User Level: </td><td><input list="Levels" name="level"></td>
            
            <td><button type="submit" name="actions" value="Users">Add User</button></td>
        </tr>
	</table>
    
    <input type="hidden" name="update" value="AddUser">
</form>
<br><br>
<form action="./Admin.php" enctype="multipart/form-data" method="post">
	<button type="submit" name="actions" value="">Back</button>
</form>