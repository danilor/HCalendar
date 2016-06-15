<?php

//This function should return the HTML of the calendar
function get_calendar_month_year($month = null,$year = null,$withheader = false ){
    $calendar_row_class = 'calendar_row';
    $calendar_day = 'calendar_day';
    $calendar_day_empty = 'calendar_day_empty';
    $calendar_title_class = 'calendar_header';
    $calendar_day_header = 'calendar_day_header';
    // Open the table
    $calendar = "";

    // Default values for year and month
    if($year == null || !is_numeric($year)){
        $year = (int)date("Y");
    }
    if($month == null || !is_numeric($month)){
        $month = (int)date("m");
    }

    //We get the dated information
    $dated = new DateTime("now");
	$dated -> setDate((int)$year,(int)$month,1); //We set up the first day of this month/year
	$dated -> modify('first day of this month'); // There is no actual need to move to the first day of the month, but just in case.

    if($withheader){
        $calendar .= "<p class='".$calendar_title_class."'>".$dated->format("F")."</p>"; //This is to print the full month name
    }

	$calendar .= '<table class="calendar_class" id="calendar_table">';
	$headings = array('Su','Mo','Tu','We','Th','Fr','Sa');
	$calendar .= '<tr class="'.$calendar_row_class.'">';
	//We print all headers of the table. TODO move this function into a class?
	foreach($headings AS $h){
            $calendar.= '<td class="'.$calendar_day_header.'">'.$h.'</td>';
	}
	$calendar.= '</tr>';

	$first_day_month = $dated->format("w"); // We get the number of the day in the week of the first day of this month
	$days_in_month = $dated->format("t"); // And we get the number of days of this month
	$days_in_this_week = 1;
	$day_counter = 0;
	$calendar .= '<tr class="'.$calendar_row_class.'">';
	for($i = 0; $i < $first_day_month; $i++){
	    $calendar.= '<td class="'.$calendar_day_empty.'"> </td>';
		$days_in_this_week++;
	}
	for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
        $calendar .= '<td class="'.$calendar_day.'">';
        $calendar .= '<div class="day-number">' . $list_day . '</div>';
        $calendar .= str_repeat('<p> </p>', 2);
        $calendar .= '</td>';
        if ($first_day_month == 6) {
            $calendar .= '</tr>';
            if (($day_counter + 1) != $days_in_month) {
                $calendar .= '<tr class="' . $calendar_row_class . '">';
            }
            $first_day_month = -1;
            $days_in_this_week = 0;
        }
        $days_in_this_week++;
        $first_day_month++;
        $day_counter++;
    }
	if($days_in_this_week < 8) {
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++) {
            $calendar .= '<td class="'.$calendar_day_empty.'"> </td>';
        }
    }
	$calendar.= '</tr>';
	$calendar.= '</table>';
	return $calendar;
}