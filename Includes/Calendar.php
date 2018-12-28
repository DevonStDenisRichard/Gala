
<?php
	
	if(isset($_GET['Month']))
		$month1 = $_GET['Month'];
	else
		$month1 = date('n');

	if(isset($_GET['Year']))
		$year1 = $_GET['Year'];
	else
		$year1 = date('Y');
		
	$dateObj   = DateTime::createFromFormat('!m', $month1);
	$monthName = $dateObj->format('F');

	$nextm = $month1 + 1;
	$prevm = $month1 - 1;
	$prevy = $year1;
	$nexty = $year1;
		
	if($prevm < 1)
	{
		$prevm = 12;
		$prevy = $year1 - 1;
	}
	
	if($nextm > 12)
	{
		$nextm = 1;
		$nexty = $year1 + 1;
	}
	

	print "<br><ArticleBoxTitle><center><a href=\"./index.php?page=Calendar&Year=" . $prevy . "&Month=" . $prevm . "\"><img src=\"./Images/Left.jpg\" alt=\"Left Arrow\"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $monthName . ", " . $year1 . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"./index.php?page=Calendar&Year=" . $nexty . "&Month=" . $nextm . "\"><img src=\"./Images/Right.jpg\" alt=\"Left Arrow\"></a></center></ArticleBoxTitle><article class=\"ArticleBox\" >" . draw_calendar($month1, $year1,  $year1, $month1) . "</article>";

	print "&nbsp;&nbsp;&nbsp;<table><tr><td bgcolor=\"#FBB36D\">&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Events on these days</td></tr></table>";
	
	function draw_calendar($month,$year, $year1, $month1){
include("./Includes/mysql551.php");
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row0"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		
		$DateOfDay = $year1 . "-" . $month1 . "-" . $list_day;
		
		$query = "SELECT count(*) FROM `calendar` WHERE `Date1` = '" . $DateOfDay . "'";
		$result = $DB2->fetchdata($query);
			
		$calendar.= '<td class="calendar-day" ';
		
		if($result[0]['count(*)'] > 0)
			$calendar.= 'style="background-color:#FBB36D;"';
			
		$calendar.= '>';
		
		/* add in the day number */
		$calendar.= '<div class="day-number">'.$list_day.'</div>';
		
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		$calendar.= str_repeat('<p> </p>',2);
		
		if($result[0]['count(*)'] > 0)
			$calendar.= '<br><br><center><font><a href="./index.php?page=Events&Date=' . $DateOfDay . '">View Events</a></font></center>';
		else
			$calendar.= '&nbsp;';
				
		$calendar.= '</td>';
		
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
?>