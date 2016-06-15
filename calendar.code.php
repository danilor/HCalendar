<?php
    global $dated,$days,$cc,$calendar;

    function page_init(){
        global $dated,$days,$cc,$calendar;
        $days = 30; // A default value for the days
        $cc = "US"; // Default value for the country code
        $dated = new DateTime();
        if(isset($_GET["date"])){
            $got_date = $_GET["date"];
            $dated = DateTime::createFromFormat('m/d/Y',$got_date);
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

        $calendar = new Calendar($cc);
    }

    // We start the page.
    page_init();