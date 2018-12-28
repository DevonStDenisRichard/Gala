<?php
	if(isset($_GET['index']))
		$offset = $_GET['index'];
	else
		$offset = 0;
	
	$CurrentIndex = $offset;
	$Range = $MinutesCount * ($offset + 1);	
	$offset = $MinutesCount * $offset;

	$query = "select count(`Index1`) as num_rows from `minutes`";
	$result = $DB1->fetchdata($query);
	
	$TotalRows = $result[0]['num_rows'];
	
	
	if($offset == 0)
		$query = "SELECT * FROM `minutes` ORDER BY `Index1` DESC LIMIT " . $MinutesCount .";";
	else
	{
		$offset = $offset -0;
		$query = "SELECT * FROM `minutes` ORDER BY `Index1` DESC LIMIT " . $MinutesCount . " OFFSET " . $offset . ";";
	}

	print "<article class=\"ArticleBox\" style=\"width:97%;\"><div id=\"articlespace\"><ArticleBoxTitle>Meeting Minutes</ArticleBoxTitle><br><br>";
	
	$result = $DB1->fetchdata($query);
	
	for($c=0; $c < count($result); $c++)
	{
		print "<h1><a style=\"color:#00A2E8;\" href=\"" . $result[$c]['PhysicalLocation'] . "\">" . $result[$c]['Title'] . "</a></h1>";
	}
	print "</div><br> &nbsp;";
	
	if($offset > 0)
		print "<a style=\"color: #000000;\" href=\"./index.php?page=Archives&index=" . ($CurrentIndex - 1) . "\">< Previous</a> &nbsp;";
	
	if($Range < $TotalRows)
		print "&nbsp; <a style=\"color: #000000;\" href=\"./index.php?page=Archives&index=" . ($CurrentIndex + 1) . "\">Next ></a>";
	
	print "</article>";
?>