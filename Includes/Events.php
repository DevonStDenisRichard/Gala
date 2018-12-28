
<?php
	
	if(isset($_GET['Date']))
		$Date = $_GET['Date'];
	else
		$Date = date('Y-m-d');
	
	$Date2 = date('M d, Y') . " - Events";
	$query = "SELECT * FROM `calendar` WHERE `Date1` = '" . $Date . "'";
	$result = $DB1->fetchData($query);	
	
	if(count($result > 0))
	{
		print "<article class=\"ArticleBox\" style=\"width:97%;\"><div id=\"articlespace\"><ArticleBoxTitle><center><br>" . $Date2 . "</center></ArticleBoxTitle><br><br>";
		
		for($c = 0; $c < count($result); $c++)
			print "<h1><a style=\"color:#00A2E8;\" href=\"./index.php?page=Event&Index=" . $result[$c]['Index1'] . "\">" . $result[$c]['EventTitle'] . "</a></h1>";
			
		print "</div><br>";
	}
	else
	{
		print "<article class=\"ArticleBox\" style=\"width:97%;\"><div id=\"articlespace\"><ArticleBoxTitle>" . $Date2 . "</ArticleBoxTitle><br><br>
		<h1>No Events On This Day</h1>
		</div><br>";
	}
	
?>