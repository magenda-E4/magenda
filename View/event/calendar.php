<div id="eventCalendar">

</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css" media="all"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.print.css " media="all"/>

<?php
    if(isset($currentCompany)){
        echo "<script type=\"text/javascript\" src=\"include/js/calendar\"></script>";
    }elseif (isset($currentUser)){
        echo "<script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js\"></script>";
    }
?>