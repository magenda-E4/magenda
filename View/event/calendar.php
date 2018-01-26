<h1><?php echo $title;?></h1>
<div id="eventCalendar">

</div>
<!-- Full Calendar !-->
<!-- Licence : https://fullcalendar.io/license/ -->
<script src="include/js/lib/fullCalendar/moment.min.js" type="text/javascript"> </script>
<script src="include/js/lib/fullCalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="include/js/lib/fullCalendar/locale-all.js" type="text/javascript"></script>
    <link href="include/css/lib/fullCalendar/fullcalendar.min.css" rel="stylesheet">
<link href="include/css/lib/fullCalendar/fullcalendar.print.css" rel="stylesheet" media='print'>
    <!-- /Full Calendar !-->
<?php
    echo "<script type=\"text/javascript\" src=\"include/js/calendar/ViewCalendar.js\"></script>\n";
    if(isset($currentCompany)){
        echo "<script type=\"text/javascript\" src=\"include/js/calendar/ViewCalendarCompany.js\"></script>\n";
        echo "<script type=\"text/javascript\">
            $(document).ready(function() {
               var calendarCompany = new ViewCalendarCompany(document.querySelector(\"#eventCalendar\"), ".$currentCompany->getId().");
               calendarCompany.prepare();
           });
            </script>\n";
    }elseif (isset($currentUser)){
        echo "<script type=\"text/javascript\" src=\"include/js/calendar/ViewCalendarUser.js\"></script>\n";
        echo "<script type=\"text/javascript\">
            $(document).ready(function() {
               var calendarUser = new ViewCalendarUser(document.querySelector(\"#eventCalendar\"), ".$currentUser->getId().");
               calendarUser.prepare();
           });
            </script>\n";
    }
?>