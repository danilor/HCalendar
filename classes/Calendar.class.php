<?php
/*
 * This class will take over all functions of the calendar
 * */
class Calendar{
    private $country_code = "";
    private $holydays = []; //The idea is to store the holidays per year-month in this variable
    private $headings = array('Su','Mo','Tu','We','Th','Fr','Sa');
    private $last_calendar = "";
    private $allowed_years = [2008]; //This is the list of years that can use the function of getting the holidays
    // cc means country code
    public function __construct($cc = ''){
            $this->country_code = $cc;
    }
    /*
     * We are goint to get the holidays from an specific year. If the year is null we can use the current one.
     * */
    public function get_holydays($year = null,$month = null){
        if($year == null || !is_numeric($year)){
            $year = (int)date("Y");
        }
        if($month == null || !is_numeric($month)){
            $month = (int)date("m");
        }
    }

    //This function should return the HTML of the calendar
    // param @onlydays If this param is different from null, then we are only going to print the days in this parameter
    public function getCalendarMonthYear($month = null,$year = null,$withheader = false,$onlydays = [] ){


        $calendar_row_class = 'calendar_row';
        $calendar_day = 'calendar_day';
        $calendar_day_empty = 'calendar_day_empty';
        $calendar_title_class = 'calendar_header';
        $calendar_day_header = 'calendar_day_header';
        $calendar_day_number = 'calendar_day_number';
        $calendar_day_weekend = 'calendar_day_weekend';
        $calendar_day_weekday = 'calendar_day_weekday';
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
            $calendar .= "<p class='".$calendar_title_class."'>".$dated->format("F Y")."</p>"; //This is to print the full month name
        }

        $calendar .= '<table class="calendar_class" id="calendar_table">';

        $calendar .= '<tr class="'.$calendar_row_class.'">';
        //We print all headers of the table. TODO move this function into a class?
        foreach($this->headings AS $h){
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

            $extra = "";
            if($first_day_month == 0 || $first_day_month == 6){
                $extra = " " . $calendar_day_weekend;
            }else{
                $extra = " " . $calendar_day_weekday;
            }

            $fm = str_pad($month,2,"0",STR_PAD_LEFT).str_pad($list_day,2,"0",STR_PAD_LEFT).str_pad($year,4,"0",STR_PAD_LEFT);

            if(count($onlydays) == 0){
                $calendar .= '<td df="'.($month.$list_day.$year).'" ld="'.$list_day.'" dc="'.$day_counter.'" fdm="'.$first_day_month.'" class="'.$calendar_day . $extra . '">';
                $calendar .= '<div class="'.$calendar_day_number.'">' . $list_day . '</div>';
                $calendar .= str_repeat('<p> </p>', 2);
                $calendar .= '</td>';
            }else{

                if( in_array($fm,$onlydays)  ){
                    $calendar .= '<td df="'.($fm).'" ld="'.$list_day.'" dc="'.$day_counter.'" fdm="'.$first_day_month.'" class="'.$calendar_day . $extra . '">';
                    $calendar .= '<div class="'.$calendar_day_number.'">' . $list_day . '</div>';
                    $calendar .= str_repeat('<p> </p>', 2);
                    $calendar .= '</td>';
                }else{
                    $calendar .= '<td df="'.($fm).'" ld="'.$list_day.'" dc="'.$day_counter.'" fdm="'.$first_day_month.'" class="'.$calendar_day_empty . '">';
                    $calendar .= '<div class="">&nbsp;</div>';
                    $calendar .= str_repeat('<p> </p>', 2);
                    $calendar .= '</td>';
                }

            }

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
        $this -> last_calendar = $calendar;
        return $calendar;
    }

    public function getLastCalendar(){
        return $this->last_calendar;
    }
}