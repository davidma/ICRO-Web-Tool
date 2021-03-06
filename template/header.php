<?php

 require_once("classes/Sentry.php");
 require_once("classes/DBLink.php");
 require_once("classes/Validator.php");
 require_once("classes/SMS.php");
 require_once("classes/Mapper.php");
 require_once("classes/Logger.php");
 require_once("classes/JSON.php");
 require_once('calendar/classes/tc_calendar.php');

 // These objects are now available for use on every page.... 
 $theSentry = new Sentry();
 $theDB = new DBLink();
 $theLogger = new Logger($theDB);
 $theValidator = new Validator();
 $theSMS = new SMS();
 $json = new Services_JSON();

 echo '<html>';
 echo '<head><title>ICRO - Irish Cave Rescue Organisation</title>';
 echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
 echo '<LINK rel="stylesheet" type="text/css" href="css/default.css">';

 // The ICRO Ajax Library
 echo "<script type='text/javascript' src='scripts/icro_ajax.js'></script>";
 echo "<script type='text/javascript' src='calendar/calendar.js'></script>";

 echo '</head><body><div class="mainframe">';
 echo "<div class='dateheader'>".date('l jS \of F Y')."</div>";
 echo "<div class='maintitle'><br/></div>";
 echo "<div class ='bodyheader'>";
 echo "<div style='float:left'>";

 if (isset($_SESSION['username']) )
 {
        echo 'Logged in as '.$_SESSION['username'].' - <a href="logout.php">Logout?</a>';
 }
 else
 {
        echo '<a href="login.php">Login</a>';
 }

 echo "</div><div style='float:right'><a href='index.php'>Home</a>";

 if (isset($_SESSION['username']))
 {
     echo '&nbsp;~&nbsp;<a href="profile.php">My Profile</a>';
     echo '&nbsp;~&nbsp;<a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=52.70194626,-8.92472267" target="_blank">Clare Weather</a>';
     echo '&nbsp;~&nbsp;<a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=54.418%2C-7.822&sp=IFERMANA2" target="_blank">Fermanagh Weather</a>';
     echo '&nbsp;~&nbsp;<a href="gen_calloutlist.php">Callout List</a>';
 }

 echo "</div><div style='clear:both'></div></div>";
 echo "<div class='content'>";

?>
