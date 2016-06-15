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
                            <input class="datepicker" type="text" name="date" id="date" required="required" />
                        </p>
                        <p>
                            <label>Number of Days *</label><br />
                            <input type="number" min="0" name="days" id="days" required="required" />
                        </p>
                        <p>
                            <label>Country Code *</label><br />
                            <input type="text" name="cc" id="cc" required="required" />
                        </p>
                        <p>
                            <input type="submit" value="GET" />
                        </p>
                    </form>

                </div>
        </div>
    </body>
    <?php include("blocks/scripts.php"); ?>
</html>
