<?php include("config.php"); ?>
<?php include("calendar.code.php"); ?>
<!DOCTYPE HTML>
<html>
    <?php include("blocks/head.php"); ?>
    <body>
            <div class="wrapper">
                <div class="col-xs-12">
                    <h1>Calendar Display</h1>
                    <h4>Date since: <?php echo $dated->format("m/d/Y") ?> | Days: <?php echo $days ?> | Country Code: <?php echo $cc ?></h4>

                    <br />
                    <p>
                        <strong>Days to show:</strong>
                        <?php
                            foreach($days_array AS $d){
                                echo $d." ";
                            }
                        ?>
                    </p>
                    <br />
                    <?php
                        foreach($months_array AS $m){
                            $mY = explode("-",$m);
                            echo $calendar->getCalendarMonthYear((int)$mY[0],(int)$mY[1],true,$days_array); // This function should be the one
                        }
                    ?>
                </div>
            </div>


    </body>
    <?php include("blocks/scripts.php"); ?>
</html>
