<?php
	if(isset($_GET['index']))
		$offset = $_GET['index'];
	else
		$offset = 0;
	
	$CurrentIndex = $offset;
	$Range = $NewsCount * ($offset + 1);	
	$offset = $NewsCount * $offset;

	$query = "select count(`Index1`) as num_rows from `news`";
	$result = $DB1->fetchdata($query);
	
	$TotalRows = $result[0]['num_rows'];
	
	if($TotalRows > 0)
	{
		if($offset == 0)
			$query = "SELECT * FROM `news` ORDER BY `Index1` DESC LIMIT " . $NewsCount .";";
		else
		{
			$offset = $offset -0;
			$query = "SELECT * FROM `news` ORDER BY `Index1` DESC LIMIT " . $NewsCount . " OFFSET " . $offset . ";";
		}
	
		$result = $DB1->fetchdata($query);
		
		for($c=0; $c < count($result); $c++)
		{
			$stripped = strip_tags($result[$c]['Summary']);
	
			if(strlen($stripped) > 400)
				$art = substr($stripped,0,400) . " ...";
			else
				$art = $stripped;
		
			$date = new DateTime($result[$c]['Date']);
	
			if($result[$c]['ImageLocation'] != NULL)
			{
				print "<article class=\"ArticleBox\" ><div id=\"articlespace\"><img class=\"NewsImage\" src=\"" . $result[$c]['ImageLocation'] . "\" alt=\"" . $result[$c]['Title'] . "\"><ArticleBoxTitle>" . $result[$c]['Title'] . "</ArticleBoxTitle><div class=\"DateFormat\"><br> &nbsp;" . $date->format('M d Y, H:i a') . "</div><br><ArticleSubBox>" . $art . "</ArticleSubBox><br><br></div>
					<table id=\"articletable\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"60%\" bgcolor=\"#FF1111\"></td><td align=\"right\"><a href=\"index.php?page=Story&index=" . $result[$c]['Index1'] . "\"><font class=\"BlueLink\" color=\"#00A2E8\">...More</font></a></td></tr></table>
				</article>";
			}
			else
			{
				print "<article class=\"ArticleBox\" ><div id=\"articlespace\"><ArticleBoxTitle>" . $result[$c]['Title'] . "</ArticleBoxTitle><div class=\"DateFormat\"><br> &nbsp;" . $date->format('M d Y, H:i a') . "</div><br><ArticleSubBox>" . $art . "</ArticleSubBox><br><br></div>
					<table id=\"articletable\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"60%\" bgcolor=\"#FF1111\"></td><td align=\"right\"><a href=\"index.php?page=Story&index=" . $result[$c]['Index1'] . "\"><font class=\"BlueLink\" color=\"#00A2E8\">...More</font></a></td></tr></table>
				</article>";	
			}
		}
		
		if($offset > 0)
			print "<a style=\"color: #000000;\" href=\"./index.php?page=News&index=" . ($CurrentIndex - 1) . "\">< Previous</a> &nbsp;";
		
		if($Range < $TotalRows)
			print "&nbsp; <a style=\"color: #000000;\" href=\"./index.php?page=News&index=" . ($CurrentIndex + 1) . "\">Next ></a>";
		
		print "</article>";
	}
	else
		print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>Sorry, No News Yet.</ArticleBoxTitle>";
?>