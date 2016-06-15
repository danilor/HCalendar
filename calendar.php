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
                    <?php
                        echo get_calendar_month_year($dated->format("m"),$dated->format("Y"),true); // This function should be the one
                    ?>
                </div>
            </div>


    </body>
    <?php include("blocks/scripts.php"); ?>
</html>
