<?php
$AdCount = 3;
$NewsCount = 6;
$NewspaperCount=0;
$MinutesCount=15;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gala</title>
<link rel="stylesheet" type="text/css" href="./Style.css">
</head>

<style>

</style>

<script language="javascript">
window.onload = function() {
    
	var a = document.getElementsByClassName('LeftPanel').item(0).scrollHeight;
	var b = document.getElementsByClassName('RightPanel').item(0).scrollHeight;
	var c = document.getElementsByClassName("R").item(0);

	if(b > a)
		c.setAttribute("style","height:" + b + "px;");
	else
		c.setAttribute("style","height:" + a + "px;");
};
	
</script>

<body>
    <header class="HeadPanel">
    	<TitleBlock>
        
        	<table width="100%" >
            	
            	<tr style="height:1.25em;">
                	<td rowspan="3" style="width:16.25em" ><img src="./Images/GalaLogoL.jpg" alt="Gala Logo" style="margin-right:0px;" ></td>
                	<td style="padding:0px; margin:0px;"><font style="font-size:1.25em">Gibson And Lansdale Area</font></td>
                </tr>
                <tr><td style="padding: 0px; margin:0px;"><font style="font-size:3.75em">&nbsp;&nbsp;GALA</font></td></tr>
                <tr><td style="padding:0px; margin:0px;"><font style="font-size:1.25em">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Community Planning Team</font></td></tr>
            </table>
       </TitleBlock>
        </header>
    
    <nav class="Menu1">
    	<MenuBlock>
        	<table id="MenuTable">
            	<tr>
<?php
	include("./Includes/mysql55.php");
	
	$query = "SELECT `MenuName` FROM `staticmenu` WHERE 1";
	$result = $DB1->fetchData($query);
	
	for($c=0; $c < count($result); $c++)
	{
		if(strtoupper($result[$c]['MenuName']) != "CONTACT US")
		{
			print"
					<td><a href=\"./index.php?page=" . $result[$c]['MenuName'] . "\">" . $result[$c]['MenuName'] . "</a> </td>
					<td><img src=\"Images/Diamond.gif\" style=\"padding-bottom:0.0625em;\"> </td>";
		}
		else
		{
			print"
					<td><a href=\"./index.php?page=News\">News</a> </td>
					<td><img src=\"Images/Diamond.gif\" style=\"padding-bottom:0.0625em;\"> </td>
					<td><a href=\"./index.php?page=The Herald\">The Herald</a> </td>
					<td><img src=\"Images/Diamond.gif\" style=\"padding-bottom:0.0625em;\"> </td>
					<td><a href=\"./index.php?page=Calendar\">Calendar</a> </td>
                    <td><img src=\"Images/Diamond.gif\" style=\"padding-bottom:0.0625em;\"> </td>
					<td><a href=\"./index.php?page=Archives&index=0\">Archives</a> </td>
                    <td><img src=\"Images/Diamond.gif\" style=\"padding-bottom:0.0625em;\"> </td>
                    <td><a href=\"./index.php?page=" . $result[$c]['MenuName'] . "\">" . $result[$c]['MenuName'] . "</a> </td>";
		}
	}
	
?>
                	
                    
                </tr>
            </table>
     	</MenuBlock>
	</nav>
    <!-- Articles ............................................................... -->
    
    <section class="LeftPanel">
    
<?php
	if(isset($_GET['page']))
	{
		$query = "SELECT * FROM `staticmenu` WHERE `MenuName` LIKE '" . $_GET['page'] . "'";
		$result = $DB1->fetchData($query);
		
		if(count($result) > 0)
		{
			print"
			<article class=\"ArticleBox\" style=\"width:97%;\">
				<div id=\"articlespace\">" . $result[0]['Content'] . "<br></div>
			</article>";
		}
		else
		{
			if($_GET['page'] == "Archives")
				include("./Includes/Archives.php");	
			elseif($_GET['page'] == "News")
				include("./Includes/News.php");	
			elseif($_GET['page'] == "Story")
				include("./Includes/Story.php");
			elseif($_GET['page'] == "The Herald")
				include("./Includes/Issues.php");
			elseif($_GET['page'] == "Article")
				include("./Includes/Article.php");
			elseif($_GET['page'] == "Calendar")
				include("./Includes/Calendar.php");
			elseif($_GET['page'] == "Events")
				include("./Includes/Events.php");
			elseif($_GET['page'] == "Event")
				include("./Includes/Event.php");
		}
	}
	else
	{
		include("./Includes/News.php");
	}
	
?>    		
        <!--article class="ArticleBox"><div id="articlespace"><ArticleBoxTitle>Title of a neat box</ArticleBoxTitle><br>Oct 6,<br></div>
	        <table id="articletable" cellpadding="0" cellspacing="0"><tr><td width="60%" bgcolor="#FF1111"></td><td align="right">...More</td></tr></table>
        </article-->
    </section>
    <section class="R">
    &nbsp;
    </section>
    
    <section class="RightPanel">
    	Next Meeting
        
    	<table id="CalendarTable" border="0">
        	<tr>
            	<td style="background-image:url(Images/Calendar.gif); background-repeat:no-repeat; background-size:auto; background-position:bottom; height:10em;" valign="top">
                	<font color="#FFFFFF" style="font-family:Arial;"><div style="margin-top:0.3em; font-size:1.75em"><?php 
						$query = "SELECT * FROM `calendar` WHERE `Date1` > NOW() ORDER BY `Date1` LIMIT 1";
						$result = $DB1->fetchData($query);
						
						if(count($result) > 0)
						{
							$monthNum = explode("-", $result[0]['Date1']);
							$monthName = date('F', mktime(0, 0, 0, $monthNum[1], 10));  
							
							print $monthName;
							
							$time1 = date('g:i A', strtotime('2010-05-29' . $result[0]['Time1']));
						}
						else
							print "TBA";
					?></div></font>
                    <br>
                    <?php
					if(count($result) > 0)
					   	print "<font color=\"#000000\" style=\"font-family:Arial; font-size:3.75em\"><div style=\"margin-top:0.1em;\">" . $monthNum[2] . "</font></div><font style=\"font-size: 1em; color:#000000;\">" . $time1 . "</font>";
					?>
                </td>
            </tr>
            <tr>
            	<td><br>
                
<?php
	$query = "SELECT * FROM `ads` WHERE `Enabled` = 1 ORDER BY RAND() LIMIT " . $AdCount . ";";					
	$result = $DB1->fetchData($query);
	
	for($c = 0; $c < count($result); $c++)
	{
     	print "<a href=\"" . $result[$c]['Website'] . "\"><img src=\"" . $result[$c]['ImageLocation'] . "\" width=\"95%\"></a>";
	}
?>
                </td>
            </tr>
        </table>
    </section>
    
    
    <footer class="BottomPanel">

            <table style="background-image:url(Images/Bar2.gif); background-repeat:repeat-x; padding-top:0.9375em; padding-left:0.625em;" width="100%">
                <tr>
                    <td style="background-color:#000000"><a class="BottomLinks" href="index.php?page=About">About</a></td>
                </tr>
                <tr>
                    <td style="background-color:#000000"><a class="BottomLinks" href="index.php?page=Calendar">Calendar</a></td>
                </tr>
                <tr>
                    <td style="background-color:#000000"><a class="BottomLinks" href="index.php?page=Archives">Archives</a></td>
                </tr>
                <tr>
                    <td style="background-color:#000000"><a class="BottomLinks" href="index.php?page=Contact Us">Contact Us</a></td>
                </tr>
            </table>
            <br>
            <font style="font-family:Arial; font-size:0.75em;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy;<?php print date('Y');?> Gala (Gibson And Lansdale Area)</font><br>&nbsp;
   	</footer>
    <br>
</body>
</html>
