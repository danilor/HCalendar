<?php include_once("config.php"); ?>
<!DOCTYPE HTML>
<html>
    <?php include("blocks/head.php"); ?>
    <body>
        <div class="wrapper">
                <div class="col-xs-12">
                    <h1>Holidays Calendar</h1>
                    <form name="days_selection" method="GET" target="_self" action="">
                        <p>
                            <label>Date *</label><br />
                            <input type="text" name="date" id="date" />
                        </p>
                        <p>
                            <label>Number of Days *</label><br />
                            <input type="number" name="days" id="days" />
                        </p>
                        <p>
                            <label>Country Code *</label><br />
                            <input type="text" name="cc" id="cc" />
                        </p>
                    </form>
                </div>
        </div>
    </body>
    <?php include("blocks/scripts.php"); ?>
</html>
