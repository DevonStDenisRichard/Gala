<?php
	if(isset($_GET['Index']))
	{
		$offset = $_GET['Index'];
		
		$query = "SELECT * FROM `calendar` WHERE `Index1` = " . $offset;
		$result = $DB1->fetchdata($query);
		
		if(count($result) > 0)
		{
			$date = new DateTime($result[0]['Date1']);
			
			print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>" . $result[0]['EventTitle'] . "</ArticleBoxTitle><br><br><ArticleSubBox>" . $result[0]['Summary'] . "</ArticleSubBox><br><br></div>
				</article>";
		}
		else
			print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>Sorry, We can't find this Event.</ArticleBoxTitle>";
	}
	else
		print "<article class=\"ArticleBox\" style=\"width:95%\"><div id=\"articlespace\"><ArticleBoxTitle>Sorry, We can't find this Event.</ArticleBoxTitle>";
?>