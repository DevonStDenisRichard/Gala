<?php
	if(isset($_GET['index']))
	{
		$offset = $_GET['index'];
		
		$query = "SELECT * FROM `news` WHERE `Index1` = " . $offset;
		$result = $DB1->fetchdata($query);
		
		if(count($result) > 0)
		{
			$date = new DateTime($result[0]['Date']);
			
			print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>" . $result[0]['Title'] . "</ArticleBoxTitle><div class=\"DateFormat\"><br> &nbsp;" . $date->format('M d Y, H:i a') . "</div><br><ArticleSubBox>" . $result[0]['Summary'] . "</ArticleSubBox><br><br></div>
				</article>";
		}
		else
			print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>Sorry, We can't find this story.</ArticleBoxTitle>";
	}
	else
		print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>Sorry, We can't find this story.</ArticleBoxTitle>";
?>