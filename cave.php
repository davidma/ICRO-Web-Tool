<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Cave Profile</div>
<div class='newscontent'>

<?php

 if ($theSentry->login())
 {
     if (isset($_GET['cave_id']))
     {
         $sqlstring = "select * from caves where cave_id = '".$_GET['cave_id']."'";

         $result = $theDB->fetchQuery($sqlstring);

         if(!$result)
         {
             echo "No data returned";
         }
         else
         {
             echo "<div class='rmenubox'><img src='images/cavemaps/".$result[0]['cave_id'].".png'></div>";

             echo "<div class='halfboxheader'><b>Cave</b></div><div class='halfbox'>".$result[0]['name']."</div>";
             echo "<div class='halfboxheader'><b>County</b></div><div class='halfbox'>".$result[0]['county']."</div>";
             echo "<div class='halfboxheader'><b>Latitude</b></div><div class='halfbox'>".$result[0]['lat']."</div>";
             echo "<div class='halfboxheader'><b>Longitude</b></div><div class='halfbox'>".$result[0]['lng']."</div>";
             echo "<div id='clear_both' style='clear:both;'></div>";

             echo "<div class='fullboxheader'><b>Description</b></div>";
             echo "<div class='fullbox'>".$result[0]['description']."</div>";
             
             echo "<div class='fullboxheader'><b>Linked Documents</b></div>";
             echo "<div class='fullbox'>Doc list will go here</div>";

         }
     }
     else
     {
         echo "Missing parameter";
     }
 }
 else
 {
     echo "You need to be logged in to view this page - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

