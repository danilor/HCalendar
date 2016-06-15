<?php
    // The $days_array variable will contain the list of available days in format MonthDay. Same for $months_array
    global $dated,$enddated,$days,$cc,$calendar,$days_array,$months_array;

    function page_init(){
        global $dated,$enddated,$days,$cc,$calendar,$days_array,$months_array;
        $days = 30; // A default value for the days
        $cc = "US"; // Default value for the country code
        $dated = new DateTime();
        $enddated = new DateTime();
        if(isset($_GET["date"])){
            $got_date = $_GET["date"];
            $dated = DateTime::createFromFormat('m/d/Y',$got_date);
            $enddated = DateTime::createFromFormat('m/d/Y',$got_date);


            if($dated == null){ //Its null, so we still use the current date
                    $dated = new DateTime();
            }
        }
        if(isset($_GET["days"]) && is_numeric($_GET["days"])){
            $days = $_GET["days"];
        }

        if(isset($_GET["cc"])){
            $cc = $_GET["cc"];
        }

        // We need to loop all days between the dates
        // Coudln't make it work with DatePeriod and DateInterval :(


        $enddated->add(new DateInterval('P'.$days.'D'));
        $start_date = $dated->format('Y-m-d');
        $end_date = $enddated->format('Y-m-d');
        while (strtotime($start_date) <= strtotime($end_date)) {
            //var_dump(date("md",strtotime($start_date)));
            $days_array[] = date("mdY",strtotime($start_date));
            $months_array[] = date("m-Y",strtotime($start_date));
            $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
        }

        $days_array = array_unique($days_array);
        $months_array = array_unique($months_array);
        //echo "<pre>";
        //var_dump($days_array,$months_array);
        //echo "</pre>";
        $calendar = new Calendar($cc);
    }

    function returnDates($fromdate, $todate) {
        return new \DatePeriod(
            $fromdate,
            new \DateInterval('P1D'),
            $todate->modify('+1 day')
        );
    }

    // We start the page.
    page_init();