<?php include("config.php"); ?>
<?php include("calendar.code.php"); ?>
<!DOCTYPE HTML>
<html>
    <?php include("blocks/head.php"); ?>
    <body>
            <h1>Calendar Display</h1>
            <h4>Date since: <?php echo $dated->format("m/d/Y") ?> | Days: <?php echo $days ?> | Country Code: <?php echo $cc ?></h4>

            <?php
                echo get_calendar_month_year(03,2016); // This function should be the one
            ?>

    </body>
    <?php include("blocks/scripts.php"); ?>
</html>
