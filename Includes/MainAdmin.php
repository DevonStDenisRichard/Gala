<h1>Admin Functions</h1>

<form action="./Admin.php" method="post" enctype="multipart/form-data" name="Form1">
	<table>
 <?php
 if($_SESSION['UserLevel'] == "Admin")
 {
 	Print"
    	<tr>
        	<td>Edit Users: </td><td><button type=\"submit\" value=\"Users\" name=\"actions\">Select</button></td>
        </tr>
	
        <tr>
        	<td>Edit Menu Content: </td><td><button type=\"submit\" value=\"Menus\" name=\"actions\">Select</button></td>
        </tr>";
 }
	?>
        <tr>
        	<td>Edit Calendar: </td><td><button type="submit" value="Calendar" name="actions">Select</button></td>
        </tr>
        <tr>
        	<td>Edit Advertisers: </td><td><button type="submit" value="Adverts" name="actions">Select</button></td>
        </tr>
        <tr>
        	<td>Edit Issues: </td><td><button type="submit" value="Issues" name="actions">Select</button></td>
        </tr>
         <tr>
        	<td>Edit Minutes: </td><td><button type="submit" value="Minutes" name="actions">Select</button></td>
        </tr>
        <tr>
        	<td>Edit News: </td><td><button type="submit" value="News" name="actions">Select</button></td>
        </tr>
    </table>
</form>