<?php
	$query="SELECT DISTINCT `Volume`, `Issue` FROM `articles` ORDER BY `Volume` Desc, `Issue` DESC ";
	$result = $DB1->fetchdata($query);
	
	
	print "<div style=\"margin-left:0.75em;\"><form action=\"./Index.php\" enctype=\"multipart/form-data\" method=\"get\">
			<select name=\"Volume\">";
	
	for($c = 0; $c < count($result); $c++)
	{
		print "<option value=\"Volume: " . $result[$c]['Volume'] . ", Issue: " .  $result[$c]['Issue'] . "\"";
	   
		if(isset($_GET['Volume']) && $_GET['Volume'] == "Volume: " . $result[$c]['Volume'] . ", Issue: " .  $result[$c]['Issue'])
			print " selected";
	   
		print ">Volume: " . $result[$c]['Volume'] . ", Issue: " .  $result[$c]['Issue'] . "</option><br>";
	}
	
	print "</select>
	
		<button type=\"submit\" name=\"page\" value=\"The Herald\">Switch to Volume/Issue</button>
	 </form></div>";
	
	if(isset($_GET['Volume']))
 		$Volume = $_GET['Volume'];
	else
		$Volume = "Volume: " . $result[0]['Volume'] . ", Issue: " .  $result[0]['Issue'];
		
		$Parts = explode(":", $Volume);
		$Vol = explode(",", $Parts[1]);
		$Vol = trim($Vol[0]);
		$Iss = trim($Parts[2]);
	

	$query = "SELECT * FROM `articles` WHERE `Volume` LIKE '" . $Vol . "' AND `Issue` LIKE '" . $Iss . "';";
	$result = $DB1->fetchdata($query);
	
	for($c = 0; $c < count($result); $c++)
	{
		$date = new DateTime($result[$c]['Date1']);
		
		if($result[$c]['PhysicalLocation'] != NULL)
		{
			print "<article class=\"ArticleBox\" ><div id=\"articlespace\"><ArticleBoxTitle>" . $result[$c]['Title'] . "</ArticleBoxTitle><div class=\"DateFormat\"><br> &nbsp;" . $date->format('M d Y, H:i a') . "</div><br><ArticleSubBox><a href=\"" . $result[$c]['PhysicalLocation'] . "\"><font class=\"BlueLink\" color=\"#00A2E8\">View PDF</font></a></ArticleSubBox><br><br></div>
			</article>";	
		}
		else
		{
			$stripped = strip_tags($result[$c]['Article']);
	
			if(strlen($stripped) > 400)
				$art = substr($stripped,0,400) . " ...";
			else
				$art = $stripped;
		
			$date = new DateTime($result[$c]['Date1']);
			
			print "<article class=\"ArticleBox\" ><div id=\"articlespace\"><ArticleBoxTitle>" . $result[$c]['Title'] . "</ArticleBoxTitle><div class=\"DateFormat\"><br> &nbsp;" . $date->format('M d Y, H:i a') . "</div><br><ArticleSubBox>" . $art . "</ArticleSubBox><br><br></div>
				<table id=\"articletable\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"60%\" bgcolor=\"#FF1111\"></td><td align=\"right\"><a href=\"index.php?page=Article&index=" . $result[$c]['Index1'] . "\"><font class=\"BlueLink\" color=\"#00A2E8\">...More</font></a></td></tr></table>
			</article>";	

		}
	 
	 //print "<article class=\"ArticleBox\">asfaf</article>";
	}
	 
?>

